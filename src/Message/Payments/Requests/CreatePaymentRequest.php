<?php

namespace PHPAccounting\MyobEssentials\Message\Payments\Requests;

use PHPAccounting\MyobEssentials\Helpers\IndexSanityInsertionHelper;
use PHPAccounting\MyobEssentials\Message\AbstractRequest;
use PHPAccounting\MyobEssentials\Message\Payments\Responses\CreatePaymentResponse;

/**
 * Create Invoice
 * @package PHPAccounting\MyobEssentials\Message\Invoices\Requests
 */
class CreatePaymentRequest extends AbstractRequest
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
     * @return \Omnipay\Common\Message\ResponseInterface|CreatePaymentResponse
     */
    public function sendData($data)
    {
        $response = [];
        return $this->createResponse($response->getElements());
    }

    /**
     * Create Generic Response from Xero Endpoint
     * @param mixed $data Array Elements or Xero Collection from Response
     * @return CreatePaymentResponse
     */
    public function createResponse($data)
    {
        return $this->response = new CreatePaymentResponse($this, $data);
    }


}