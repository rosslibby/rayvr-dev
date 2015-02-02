<?php

use RAYVR\Storage\User\UserRepository as User;
use Omnipay\Omnipay;

class PaymentController extends BaseController {
	public function payments()
	{
		return View::make('payments.index');
	/*	$gateway = Omnipay::create('Stripe');
		$gateway->setApiKey('sk_test_3YmCSPqFkZCBhSroMCu4QAC0');

		$formData = [
			'number' => '4242424242424242',
			'expiryMonth' => '6',
			'expiryYear' => '2016',
			'cvv' => '123'
		];

		$response = $gateway->purchase([
			'amount' => '10.00',
			'currency' => 'USD',
			'card' => $formData
		])->send();

		if ($response->isSuccessful()) {
			// payment was successful: update database
			print_r($response);
		} elseif ($response->isRedirect()) {
			// redirect to offsite payment gateway
			$response->redirect();
		} else {
			// payment failed: display message to customer
			echo $response->getMessage();
		}*/
	}

	public function membership()
	{
		return View::make('payments.membership');
	}

	public function subscribe()
	{
		return View::make('payments.subscription');
	}
}