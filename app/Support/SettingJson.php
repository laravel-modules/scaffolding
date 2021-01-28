<?php

namespace App\Support;

use Laraeast\LaravelSettings\Facades\Settings;

class SettingJson
{
    /**
     * The config replacement array.
     *
     * @return array
     */
    public function getConfigReplacement()
    {
        return [
            'dashboard_template' => Settings::get('dashboard_template'),
            'frontend_template' => Settings::get('frontend_template'),
            'mail_driver' => Settings::get('mail_driver'),
            'mail_host' => Settings::get('mail_host'),
            'mail_port' => Settings::get('mail_port'),
            'mail_username' => Settings::get('mail_username'),
            'mail_password' => Settings::get('mail_password'),
            'mail_from_address' => Settings::get('mail_from_address'),
            'mail_from_name' => Settings::get('mail_from_name'),
            'mail_encryption' => Settings::get('mail_encryption'),
            'broadcast_driver' => Settings::get('broadcast_driver'),
            'pusher_app_id' => Settings::get('pusher_app_id'),
            'pusher_app_key' => Settings::get('pusher_app_key'),
            'pusher_app_secret' => Settings::get('pusher_app_secret'),
            'pusher_app_encrypted' => Settings::get('pusher_app_encrypted'),
            'pusher_app_host' => Settings::get('pusher_app_host'),
            'pusher_app_port' => Settings::get('pusher_app_port'),
            'pusher_app_scheme' => Settings::get('pusher_app_scheme'),
        ];
    }

    /**
     * Set the settings json file.
     *
     */
    public function update()
    {
        file_put_contents(
            storage_path('settings.json'),
            json_encode($this->getConfigReplacement(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
        );
    }

    /**
     * Get the key value from settings json.
     *
     * @param $key
     * @return mixed|void
     */
    public function get($key)
    {
        if (! file_exists($file = storage_path('settings.json'))
            || ! is_array($array = json_decode(file_get_contents($file), true))) {
            return;
        }

        if (! isset($array[$key])) {
            return;
        }

        return $array[$key];
    }
}
