<?php

namespace CMPayments\PaymentSdk\Test;

use CMPayments\PaymentSdk\Credentials;

/**
 * Class CredentialsTest
 *
 * @package CMPayments\PaymentSdk\Test
 * @author  Michel Westerink <michel.westerink@cmtelecom.com>
 */
class CredentialsTest extends Common
{
    /**
     * Test the credentials object
     */
    public function testCredentials()
    {
        $credentials = new Credentials(self::OAUTH_MERCHANT_KEY, self::OAUTH_MERCHANT_SECRET);
        $this->assertInstanceOf(Credentials::class, $credentials);
        $this->assertEquals(self::OAUTH_MERCHANT_KEY, $credentials->getMerchantKey());
        $this->assertEquals(32, strlen($credentials->getMerchantKey()));
        $this->assertEquals(self::OAUTH_MERCHANT_SECRET, $credentials->getMerchantSecret());
        $this->assertEquals(64, strlen($credentials->getMerchantSecret()));
    }
}
