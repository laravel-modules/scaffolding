<?php

namespace Modules\Media\Http\Controllers;

use App\Media;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Media\Entities\TemporaryFile;
use Modules\Media\Http\Requests\MediaRequest;
use Modules\Media\Transformers\MediaResource;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('media::index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('media::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Modules\Media\Http\Requests\MediaRequest $request
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
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
            'token' => [
                'key' => 'media',
                'value' => $temporaryFile->token,
            ],
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
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Media $media)
    {
        $media->delete();

        return response()->json([
            'message' => 'deleted',
        ]);
    }
}
