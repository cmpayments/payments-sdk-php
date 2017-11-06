<?php

namespace CMPayments\PaymentSdk\Test\Entities;

use CMPayments\PaymentSdk\Entities\Payment;
use Money\Money;

class PaymentTest extends \PHPUnit_Framework_TestCase
{

    public function testUrls()
    {
        $payment = new Payment(Money::EUR(500), 'test_method', 'test_purchase_id');
        $payment->setSuccessUrl('https://success.url');
        $payment->setFailedUrl('https://failed.url');
        $payment->setCancelledUrl('https://cancelled.url');
        $payment->setExpiredUrl('https://expired.url');
        $payment->setCallbackUrl('https://callback.url');

        $payload = $payment->toArray();

        $this->assertEquals('https://success.url', $payload['payment_details']['success_url']);
        $this->assertEquals('https://failed.url', $payload['payment_details']['failed_url']);
        $this->assertEquals('https://cancelled.url', $payload['payment_details']['cancelled_url']);
        $this->assertEquals('https://expired.url', $payload['payment_details']['expired_url']);
        $this->assertEquals('https://callback.url', $payload['payment_details']['callback_url']);
    }
}
