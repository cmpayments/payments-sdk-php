<?php

namespace CMPayments\PaymentSdk\Test\Entities;

use CMPayments\PaymentSdk\Entities\DirectDebitPayment;
use Money\Money;

class DirectDebitPaymentTest extends \PHPUnit_Framework_TestCase
{
    public function testToArray()
    {
        $payment = new DirectDebitPayment(
            Money::EUR(500),
            'test_purchase_id',
            'NL52CMPT0000000020',
            'T Ester',
            'mandate_id',
            new \DateTime('2017-06-07 12:23:45', new \DateTimeZone('UTC')),
            'description',
            'transaction_description'
        );

        $payload = $payment->toArray();

        $this->assertEquals('2017-06-07', $payload['payment_details']['mandate_start_date']);
        $this->assertEquals('mandate_id', $payload['payment_details']['mandate_id']);
        $this->assertEquals('NL52CMPT0000000020', $payload['payment_details']['bank_account_number']);
        $this->assertEquals('T Ester', $payload['payment_details']['name']);
        $this->assertEquals('description', $payload['payment_details']['description']);
        $this->assertEquals('transaction_description', $payload['payment_details']['transaction_description']);
    }
}
