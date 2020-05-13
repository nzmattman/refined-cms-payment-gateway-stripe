<?php

namespace RefinedDigital\PaymentGateways\Stripe\Module\Classes;

use RefinedDigital\CMS\Modules\Core\Classes\PaymentGateway;
use RefinedDigital\CMS\Modules\Core\Contracts\PaymentGatewayInterface;

class Stripe extends PaymentGateway implements PaymentGatewayInterface {

    protected $view = 'payment-gateways-stripe::form';

    public function process($request, $cart)
    {
        help()->trace('processing the payment');
    }
}
