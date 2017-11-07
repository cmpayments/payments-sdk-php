# CMPayments Payment SDK for PHP

[![Build Status][badge-build]][build]
[![Scrutinizer][badge-quality]][quality]
[![Coverage][badge-coverage]][quality]
[![Software License][badge-license]][license]
[![Total Downloads][badge-downloads]][downloads]

Integrating the CMPayments solutions for online payments with your application is easy using the Payment SDK for PHP.

## Installation
To install the SDK, simply use [Composer](https://getcomposer.org/):
```composer require cmpayments/payments-sdk-php```

### Requirements
 - PHP 5.5+
 - PHP cURL extension
 - Up to date SSL, capable of TLS 1.0 or higher
 
### Dependencies
 - [MoneyPHP](https://github.com/moneyphp) is used to encapsulate sums of money and their currency
 - [Guzzle](https://github.com/guzzle/guzzle) is used to make HTTP requests
 
These are automatically installed by composer.

## Bootstrapping
To do anything with the SDK, the first step is to create an instance of the payment `Gateway`:

```php
<?php
use CMPayments\PaymentSdk\Credentials;
use CMPayments\PaymentSdk\Gateway;

$gateway = new Gateway(new Credentials('your-api-key', 'your-api-secret'));
```

## List iDEAL issuers
To get a list of iDEAL issuers, simply tell the `Gateway` to `execute` the `IdealIssuerListRequest`:

```php
<?php
use CMPayments\PaymentSdk\Requests\IdealIssuerListRequest;

$issuers = $gateway->execute(new IdealIssuerListRequest());

foreach ($issuers as $name => $id) {
    // $name is now 'ABN AMRO Bank', 'Rabobank', 'ING', etc.
    // $id is now 'ABNANL2A', 'RABONL2U', 'INGBNL2A', etc.
}
```

## Start a payment
The CMPayments API supports the concept of a `Charge` that contains 0..n `Payment` items underneath it. To start a payment, both a `Charge` and a `Payment` must be created.
This can be done in one request:

```php
<?php
use CMPayments\PaymentSdk\Entities\Charge;
use CMPayments\PaymentSdk\Entities\IdealPayment;
use CMPayments\PaymentSdk\Requests\CreateChargeRequest;
use Money\Money;

//  Create both a charge and a payment object
$payment = new IdealPayment(Money::EUR(500), 'RABONL2U', 'your-unique-purchase-id', 'A description of the transaction');
$charge = new Charge(Money::EUR(500), [$payment]);

$response = $gateway->execute(new CreateChargeRequest($charge));

//  The id of the charge is available as $response->charge_id, the id of the payment in $response->payments[0]->payment_id
//  These ids are in the form of ch- (or charge) or pt- (for payment), followed by a uuid v4.
//  To have the user complete the payment, redirect them to $response->payments[0]->payment_details->authentication_url
```

*Note: Each payment method has its own {METHOD}Payment class.
Each of these classes enforces all required properties trough their constructors.
For instance, to create a new CreditCard payment, replace the `new IdealPayment(...)` line with `new CreditCardPayment(Money::EUR(500), ['VISA', 'MasterCard'], 'your-purchase-id', new \DateTime('+1 day'));`.*

## Retreive charge or a payment
Simple tell the `Gateway` to execute a `ViewChargeRequest` of `ViewPaymentRequest` with the correct id, and the details will be retrieved.

```php
<?php
use CMPayments\PaymentSdk\Requests\ViewChargeRequest;
use CMPayments\PaymentSdk\Requests\ViewPaymentRequest;

$response = $gateway->execute(
    new ViewChargeRequest('ch-fd0e1e2d-f994-4afc-a0b6-f7e76550fc31')
);
$response = $gateway->execute(
    new ViewPaymentRequest('pt-297bba0f-5fae-4ec2-8c0f-dfbc0f62f6b0')
);
```

## Handling errors
Internally, Guzzle is used to make HTTP requests. When the API responds with a 4xx or 5xx HTTP status, either a `ClientException` or a `ServerException` is thrown.

In case of a `ServerException`, the CMPayments platform is having issues. Try the request again later.

For a `ClientException`, check `$exception->getResponse()->getBody()->getContents()` to see what is wrong.

## Working with `Money`
The `Money` library in use requires that any amount is represented in the smallest unig (eg. cents),
so EUR 5,- is written as `new Money(500, new Currency('EUR'))` or shorter as `Money::EUR(500)`.

Because this can be a bit of a hassle, the `MoneyConverter` class is provided. It can convert a float + currency into a `Money` object and back.

```php
<?php
use \CMPayments\PaymentSdk\MoneyConverter;
$converter = new MoneyConverter();

$money = $converter->fromAmountAndCurrency(5.00, 'EUR');

$amount = $converter->toFloat($money);
```

[badge-build]: https://img.shields.io/travis/cmpayments/payments-sdk-php.svg?style=flat-square
[badge-quality]: https://img.shields.io/scrutinizer/g/cmpayments/payments-sdk-php.svg?style=flat-square
[badge-coverage]: https://img.shields.io/scrutinizer/coverage/g/cmpayments/payments-sdk-php.svg?style=flat-square
[badge-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[badge-downloads]: https://img.shields.io/packagist/dt/cmpayments/payments-sdk-php.svg?style=flat-square

[license]: https://github.com/cmpayments/payments-sdk-php/blob/master/LICENSE
[build]: https://travis-ci.org/cmpayments/payments-sdk-php
[quality]: https://scrutinizer-ci.com/g/cmpayments/payments-sdk-php/
[downloads]: https://packagist.org/packages/cmpayments/payments-sdk-php
