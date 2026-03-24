<?php

namespace App\Providers;

use App\Events\FeedbackSent;
use App\Events\VerificationCreated;
use App\Listeners\SendFeedbackMessage;
use App\Listeners\SendVerificationCode;
use App\Models\Customer;
use App\Observers\PhoneVerificationObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        FeedbackSent::class => [
            SendFeedbackMessage::class,
        ],
        VerificationCreated::class => [
            SendVerificationCode::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        Customer::observe(PhoneVerificationObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
