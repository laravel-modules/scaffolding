<?php

namespace App\MediaLibrary;

use DateTimeInterface;
use Spatie\MediaLibrary\UrlGenerator\BaseUrlGenerator;

class UrlGenerator extends BaseUrlGenerator
{
    /**
     * Get the url for the profile of a media item.
     *
     * @return string
     */
    public function getUrl(): string
    {
        if ($this->media->getDiskDriverName() == 'local') {
            return url('/storage/'.$this->getPathRelativeToRoot());
        }

        return '/storage/'.$this->getPathRelativeToRoot();
    }

    /**
     * Get the temporary url for a media item.
     *
     * @param \DateTimeInterface $expiration
     * @param array $options
     *
     * @return string
     */
    public function getTemporaryUrl(DateTimeInterface $expiration, array $options = []): string
    {
        return $this
            ->filesystemManager
            ->disk($this->media->disk)
            ->temporaryUrl($this->getPath(), $expiration, $options);
    }

    /**
     * Get the url to the directory containing responsive images.
     *
     * @return string
     */
    public function getResponsiveImagesDirectoryUrl(): string
    {
        return config('medialibrary.s3.domain').'/'.$this->pathGenerator->getPathForResponsiveImages($this->media);
    }
}