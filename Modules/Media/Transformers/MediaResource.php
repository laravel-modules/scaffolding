<?php

namespace Modules\Media\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Gate;

/** @mixin \App\Media */
class MediaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'url' => $this->getFullUrl(),
            'type' => $this->getType(),
            'mime_type' => $this->mime_type,
            'details' => $this->mediaDetails(),
            'status' => $this->mediaStatus(),
            'progress' => $this->when($this->mediaStatus() == 'processing', $this->getCustomProperty('progress')),
            'conversions' => $this->when($this->isImage() || $this->isVideo(), [
                'large' => $this->getFullUrl('large'),
                'medium' => $this->getFullUrl('medium'),
                'small' => $this->getFullUrl('small'),
                'thumb' => $this->getFullUrl('thumb'),
            ]),
            'links' => [
                'delete' => [
                    'href' => '#',
                    'method' => 'DELETE',
                    'ability' => Gate::allows('delete', $this->resource),
                ],
            ],
        ];
    }

    /**
     * Determine if the media type is video.
     *
     * @return bool
     */
    public function isVideo()
    {
        return $this->getType() == 'video';
    }

    /**
     * Determine if the media type is image.
     *
     * @return bool
     */
    public function isImage()
    {
        return $this->getType() == 'image';
    }

    /**
     * Determine if the media type is audio.
     *
     * @return bool
     */
    public function isAudio()
    {
        return $this->getType() == 'audio';
    }

    /**
     * Get the media type.
     *
     * @return mixed|string
     */
    public function getType()
    {
        return $this->getCustomProperty('type') ?: $this->type;
    }

    /**
     * @return array
     */
    protected function mediaDetails(): array
    {
        $duration = (float) $this->getCustomProperty('duration');

        return [
            'thumb' => $this->when($this->isVideo(), $this->getFullUrl('thumb')),
            $this->mergeWhen($this->isImage(), [
                'width' => $this->getCustomProperty('width'),
                'height' => $this->getCustomProperty('height'),
                'ratio' => (float) $this->getCustomProperty('ratio'),
            ]),
            'duration' => $this->when($this->isVideo() || $this->isAudio(), $duration),
        ];
    }

    /**
     * @return mixed
     */
    protected function mediaStatus()
    {
        return $this->getCustomProperty('status');
    }
}
