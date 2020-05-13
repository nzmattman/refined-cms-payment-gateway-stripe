<?php

namespace RefinedDigital\PaymentGateways\Stripe\Module\Providers;

use Illuminate\Support\ServiceProvider;
use RefinedDigital\CMS\Modules\Core\Models\PaymentGatewayAggregate;

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

        $this->publishes([
            __DIR__.'/../../../config/payment-gateway-stripe.php' => config_path('payment-gateway-stripe.php'),
        ], 'payment-gateway-stripe');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        app(PaymentGatewayAggregate::class)
            ->addGateway('Stripe', \RefinedDigital\PaymentGateways\Stripe\Module\Classes\Stripe::class);
    }
}
