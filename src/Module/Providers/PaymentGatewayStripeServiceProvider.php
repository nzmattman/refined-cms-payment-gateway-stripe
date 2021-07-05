<?php

namespace RefinedDigital\PaymentGatewayStripe\Module\Providers;

use Illuminate\Support\ServiceProvider;
use RefinedDigital\CMS\Modules\Core\Aggregates\PaymentGatewayAggregate;

class PaymentGatewayStripeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->addNamespace('payment-gateways-stripe', [
            base_path('resources/views'),
            __DIR__.'/../Resources/views',
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        app(PaymentGatewayAggregate::class)
            ->addGateway('Stripe', \RefinedDigital\PaymentGatewayStripe\Module\Classes\Stripe::class);
    }
}
