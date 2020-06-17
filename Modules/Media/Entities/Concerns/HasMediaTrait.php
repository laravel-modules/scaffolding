<?php

namespace Modules\Media\Entities\Concerns;

use Modules\Media\Entities\TemporaryFile;
use Modules\Media\Transformers\MediaResource;

trait HasMediaTrait
{
    use \Spatie\MediaLibrary\HasMedia\HasMediaTrait;

    /**
     * Assign all uploaded temporary files to the model.
     *
     * @return void
     */
    public function addAllMediaFromTokens()
    {
        $tokens = is_array(request('media')) ? request('media') : [];

        TemporaryFile::whereIn('token', $tokens)
            ->each(function (TemporaryFile $file) {
                foreach ($file->getMedia($file->collection) as $media) {
                    $media->forceFill([
                        'model_type' => $this->getMorphClass(),
                        'model_id' => $this->getKey(),
                    ])->save();
                }

                $file->delete();
            });
    }

    /**
     * Get all the model media of the given collection using "MediaResource".
     *
     * @param string $collection
     * @return \Illuminate\Support\Collection
     */
    public function getMediaResource($collection = 'default')
    {
        return collect(
            MediaResource::collection(
                $this->getMedia($collection)
            )->jsonSerialize()
        );
    }
}
