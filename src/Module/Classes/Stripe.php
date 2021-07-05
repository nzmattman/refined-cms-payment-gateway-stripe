<?php

namespace RefinedDigital\PaymentGatewayStripe\Module\Classes;

use RefinedDigital\CMS\Modules\Core\Classes\PaymentGateway;
use RefinedDigital\CMS\Modules\Core\Contracts\PaymentGatewayInterface;

use Omnipay\Omnipay;

class Stripe extends PaymentGateway implements PaymentGatewayInterface {

    protected $view = 'payment-gateways-stripe::form';

    public function process($request, $form, $emailData)
    {
        // todo: update to Stripe Payment Intents at some point
        //  this is the go away to another page to verify by the bank stuff

        $gateway = Omnipay::create('Stripe');
        $gateway->setApiKey(env('STRIPE_SECRET'));

        $args = [
            'amount' => $this->total,
            'currency' => $this->currency,
            'token' => $request->get('stripeToken'),
            'description' => $this->description,
        ];

        if (sizeof($this->metaData)) {
            $args['metadata'] = $this->metaData;
        }

        $response = $gateway
            ->purchase($args)
            ->send();

        $transaction = $this->logTransaction($form, $emailData, $response);

        $return = new \stdClass();
        $return->success = $response->isSuccessful();
        $return->transaction = $transaction;
        $return->message = $response->getMessage();

        return $return;
    }
}
