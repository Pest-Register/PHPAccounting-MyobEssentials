<?php

namespace PHPAccounting\MyobEssentials\Message\Payments\Requests;

use PHPAccounting\MyobEssentials\Helpers\IndexSanityInsertionHelper;
use PHPAccounting\MyobEssentials\Message\AbstractRequest;
use PHPAccounting\MyobEssentials\Message\Payments\Responses\UpdatePaymentResponse;

/**
 * Update Invoice(s)
 * @package PHPAccounting\MyobEssentials\Message\Invoices\Requests
 */
class UpdatePaymentRequest extends AbstractRequest
{

    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Send Data to Xero Endpoint and Retrieve Response via Response Interface
     * @param mixed $data Parameter Bag Variables After Validation
     * @return UpdatePaymentResponse
     */
    public function sendData($data)
    {
        $response = [];
        return $this->createResponse($response->getElements());
    }

    /**
     * Create Generic Response from Xero Endpoint
     * @param mixed $data Array Elements or Xero Collection from Response
     * @return UpdatePaymentResponse
     */
    public function createResponse($data)
    {
        return $this->response = new UpdatePaymentResponse($this, $data);
    }

}