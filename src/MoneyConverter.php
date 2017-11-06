<?php

namespace CMPayments\PaymentSdk;

use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Money;

/**
 * Class MoneyFactory provides convenience methods to make it easier to interact with different parts of the SDK.
 *
 * @package CMPayments\PaymentSdk
 * @author  Jory Geerts <jory.geerts@cm.nl>
 */
class MoneyConverter
{

    /**
     * @var ISOCurrencies
     */
    private $isoCurrencies;

    /**
     * CreateChargeRequest constructor.
     */
    public function __construct()
    {
        $this->isoCurrencies = new ISOCurrencies();
    }

    /**
     * Create a money object from a (float) amount and a currency.
     *
     * @param float  $amount
     * @param string $currencyCode
     * @return Money
     */
    public function fromAmountAndCurrency($amount, $currencyCode)
    {
        $currency = new Currency($currencyCode);
        $decimalFactor = $this->getDecimalFactor($currency);

        return new Money($amount * $decimalFactor, $currency);
    }

    /**
     * @param Money $money
     * @return float
     */
    public function toFloat(Money $money)
    {
        $decimalFactor = $this->getDecimalFactor($money->getCurrency());
        return $money->getAmount() / $decimalFactor;
    }

    /**
     * Calculate the decimal factor for a currency
     *
     * @param Currency $currency
     * @return integer
     */
    private function getDecimalFactor(Currency $currency)
    {
        $subunitSize = $this->isoCurrencies->subunitFor($currency);
        return pow(10, $subunitSize);
    }
}
