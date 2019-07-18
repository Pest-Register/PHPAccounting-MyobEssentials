<?php

namespace PHPAccounting\MyobEssentials\Message\Contacts\Requests;
use PHPAccounting\MyobEssentials\Message\AbstractRequest;
use PHPAccounting\MyobEssentials\Message\Contacts\Responses\CreateContactResponse;
use PHPAccounting\MyobEssentials\Helpers\IndexSanityCheckHelper;

/**
 * Create Contact(s)
 * @package PHPAccounting\MyobEssentials\Message\Contacts\Requests
 */
class CreateContactRequest extends AbstractRequest
{

    /**
     * Get Phones Array with Phone Details for Contact
     * @access public
     * @param array $data Array of Xero Phones
     * @return array
     */
    public function getPhoneData($data) {
        $phones = [];

        return $phones;
    }

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
     * @return \Omnipay\Common\Message\ResponseInterface|CreateContactResponse
     */
    public function sendData($data)
    {
        $response = [];
        return $this->createResponse($response->getElements());
    }

    /**
     * Create Generic Response from Xero Endpoint
     * @param mixed $data Array Elements or Xero Collection from Response
     * @return CreateContactResponse
     */
    public function createResponse($data)
    {
        return $this->response = new CreateContactResponse($this, $data);
    }

    public function getEndpoint()
    {
        // TODO: Implement getEndpoint() method.
    }
}