<?php

namespace Modules\Media\Http\Controllers;

use App\Media;
use Illuminate\Support\Str;
use Illuminate\Routing\Controller;
use Illuminate\Database\Eloquent\Builder;
use Modules\Media\Entities\TemporaryFile;
use Modules\Media\Http\Requests\MediaRequest;
use Modules\Media\Transformers\MediaResource;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $tokens = is_array(request('tokens')) ? request('tokens') : [];

        $media = Media::whereHasMorph('model', [TemporaryFile::class], function (Builder $builder) use ($tokens) {
            $builder->whereIn('token', $tokens);
        })->get();

        return MediaResource::collection($media);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Modules\Media\Http\Requests\MediaRequest $request
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function store(MediaRequest $request)
    {

        /** @var \Modules\Media\Entities\TemporaryFile $temporaryFile */
        $temporaryFile = TemporaryFile::create([
            'token' => Str::random(60),
            'collection' => $request->input('collection', 'default'),
        ]);

        if ($request->hasFile('file')) {
            $temporaryFile->addMedia($request->file)
                ->usingFileName($this->formatName($request->file))
                ->toMediaCollection($temporaryFile->collection);
        }

        foreach ($request->file('files', []) as $file) {
            $temporaryFile->addMedia($file)
                ->usingFileName($this->formatName($file))
                ->toMediaCollection($temporaryFile->collection);
        }

        return MediaResource::collection(
            $temporaryFile->getMedia(
                $temporaryFile->collection ?: 'default'
            )
        )->additional([
            'token' => $temporaryFile->token,
        ]);
    }

    /**
     * Get the formatted name of the given file.
     *
     * @param $file
     * @return string
     */
    public function formatName($file)
    {
        $extension = '.'.$file->getClientOriginalExtension();

        $name = trim($file->getClientOriginalName(), $extension);

        return Str::slug($name).$extension;
    }

    /**
     * @param \App\Media $media
     * @throws \Exception
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Media $media)
    {
        $media->delete();

        return response()->json([
            'message' => 'deleted',
        ]);
    }
}
