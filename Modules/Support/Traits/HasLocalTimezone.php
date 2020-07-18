<?php

namespace Modules\Support\Traits;

use Carbon\Carbon;

trait HasLocalTimezone
{
    /**
     * Get the client timezone.
     *
     * @return string
     */
    public function getLocalTimezone()
    {
        if (method_exists($this, 'getTimezone')) {
            return $this->getTimezone();
        }

        if (auth()->check() && $timezone = auth()->user()->timezone) {
            return $timezone;
        }

        $country = $_SERVER["HTTP_CF_IPCOUNTRY"] ?? geoip()->getLocation()->getAttribute('iso_code');

        $countryTimezone = \DateTimeZone::listIdentifiers(\DateTimeZone::PER_COUNTRY, $country);

        return $countryTimezone[0] ?? config('app.timezone');
    }

    /**
     * Return a timestamp as DateTime object.
     *
     * @return \Carbon\Carbon
     */
    public function getCreatedAtAttribute()
    {
        $timezone = $this->getLocalTimezone();

        return Carbon::parse($this->attributes['created_at'])->timezone($timezone);
    }

    /**
     * Return a timestamp as DateTime object.
     *
     * @return \Carbon\Carbon
     */
    public function getUpdatedAtAttribute()
    {
        $timezone = $this->getLocalTimezone();

        return Carbon::parse($this->attributes['updated_at'])->timezone($timezone);
    }
}
