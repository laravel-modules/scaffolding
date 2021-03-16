<?php

namespace App\Providers;

use App\Support\SettingJson;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Laraeast\LaravelSettings\Facades\Settings;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (! app()->runningInConsole() && Schema::hasTable('settings')) {
            $this->configureTemplates();
            $this->configureMail();
            $this->configurePusher();
        }
    }

    /**
     * Configure the dashboard & frontend templates.
     *
     * @return void
     */
    protected function configureTemplates()
    {
        $this->setConfigValue('dashboard_template', 'layouts.dashboard');

        $this->setConfigValue('frontend_template', 'layouts.frontend');
    }

    /**
     * Configure the application's mail driver.
     *
     * @return void
     */
    protected function configureMail()
    {
        $this->setConfigValue('mail_driver', 'mail.driver');
        $this->setConfigValue('mail_host', 'mail.host');
        $this->setConfigValue('mail_port', 'mail.port');
        $this->setConfigValue('mail_username', 'mail.username');
        $this->setConfigValue('mail_password', 'mail.password');
        $this->setConfigValue('mail_from_address', 'mail.from.address');
        $this->setConfigValue('mail_from_name', 'mail.from.name');
        $this->setConfigValue('mail_encryption', 'mail.encryption');
    }

    /**
     * Configure the application's mail driver.
     *
     * @return void
     */
    protected function configurePusher()
    {
        $this->setConfigValue('broadcast_driver', 'broadcasting.default');
        $this->setConfigValue('pusher_app_id', 'broadcasting.connections.pusher.app_id');
        $this->setConfigValue('pusher_app_key', 'broadcasting.connections.pusher.key');
        $this->setConfigValue('pusher_app_secret', 'broadcasting.connections.pusher.secret');
        $this->setConfigValue(
            'pusher_app_cluster',
            'broadcasting.connections.pusher.options.cluster',
            true
        );
        $this->setConfigValue(
            'pusher_app_encrypted',
            'broadcasting.connections.pusher.options.encrypted',
            true,
            true
        );
        $this->setConfigValue('pusher_app_host', 'broadcasting.connections.pusher.options.host');
        $this->setConfigValue('pusher_app_port', 'broadcasting.connections.pusher.options.port');
        $this->setConfigValue('pusher_app_scheme', 'broadcasting.connections.pusher.options.scheme');
    }

    /**
     * Override config value from settings.
     *
     * @param $settingKey
     * @param $config
     * @param bool $force
     * @param bool $bool
     */
    protected function setConfigValue($settingKey, $config, $force = false, $bool = false)
    {
        if (($value = $this->app->make(SettingJson::class)->get($settingKey)) || $force) {
            config()->set([
                $config => $bool ? ! ! $value : $value,
            ]);
        }
    }
}
