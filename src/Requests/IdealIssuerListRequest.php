<?php

namespace CMPayments\PaymentSdk\Requests;

/**
 * Request the iDEAL issuers.
 *
 * @package CMPayments\PaymentSdk\Requests
 * @author Jory Geerts <jory.geerts@cm.nl>
 */
class IdealIssuerListRequest implements RequestInterface
{
    /** @inheritdoc */
    public function getEndpoint()
    {
        return 'issuers/v1/ideal';
    }

    /** @inheritdoc */
    public function getRequestMethod()
    {
        return 'GET';
    }

    /** @inheritdoc */
    public function getPayload()
    {
        return null;
    }
}
