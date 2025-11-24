<?php

namespace App\Support;

use Illuminate\Support\Str;
use Propaganistas\LaravelPhone\PhoneNumber;

class Phone
{
    /**
     * Normalize phone number to E.164 based on config/phone.php.
     */
    public static function make(string|int|null $phoneNumber): ?string
    {
        if (! $phoneNumber) {
            return null;
        }

        $phoneNumber = trim($phoneNumber);

        // Convert "00" or "٠٠" prefixes to "+"
        $phoneNumber = preg_replace('/^(00|٠٠)/u', '+', $phoneNumber);

        // If number already starts with "+", just validate and normalize
        if (Str::startsWith($phoneNumber, '+')) {
            try {
                return (new PhoneNumber($phoneNumber))->formatE164();
            } catch (\Throwable) {
                return null;
            }
        }

        $region = config('phone.default_region');

        // If no region defined, user must provide full international format
        if (is_null($region)) {
            return null;
        }

        // Convert local number to E.164 using configured region
        try {
            return (new PhoneNumber($phoneNumber, $region))->formatE164();
        } catch (\Throwable) {
            return null;
        }
    }

    /**
     * Convert number to national/local format.
     */
    public static function toLocal(string|int|null $phoneNumber): ?string
    {
        $normalized = self::make($phoneNumber);

        if (! $normalized) {
            return null;
        }

        return (new PhoneNumber($normalized))->formatNational();
    }
}
