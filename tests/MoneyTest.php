<?php

namespace CMPayments\PaymentSdk\Test;

use CMPayments\PaymentSdk\MoneyConverter;
use Money\Money;

/**
 * Class MoneyTest
 *
 * @package CMPayments\PaymentSdk\Test
 * @author  Michel Westerink <michel.westerink@cmtelecom.com>
 */
class MoneyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test if the money object will work as expected
     */
    public function testMoneyObject()
    {
        $amount = 15.95;
        $currency = 'EUR';
        /** @var Money $money */
        $money = (new MoneyConverter())->fromAmountAndCurrency($amount, 'EUR');
        $this->assertInstanceOf(Money::class, $money);
        //Note: The money class stores the amount as integer (amount*100 for euro)
        $this->assertEquals($money->getAmount(), $amount*100);
        $this->assertEquals($money->getCurrency(), $currency);
    }
}
