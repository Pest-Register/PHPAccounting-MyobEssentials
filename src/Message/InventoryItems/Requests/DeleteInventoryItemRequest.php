<?php

namespace PHPAccounting\MyobEssentials\Message\InventoryItems\Requests;

use PHPAccounting\MyobEssentials\Helpers\IndexSanityCheckHelper;
use PHPAccounting\MyobEssentials\Message\AbstractRequest;
use PHPAccounting\MyobEssentials\Message\Accounts\Responses\DeleteAccountResponse;
use PHPAccounting\MyobEssentials\Message\InventoryItems\Responses\DeleteInventoryItemResponse;


/**
 * Delete InventoryItems(s)
 * @package PHPAccounting\MyobEssentials\Message\InventoryItems\Requests
 */
class DeleteInventoryItemRequest extends AbstractRequest
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
     * @return \Omnipay\Common\Message\ResponseInterface|DeleteAccountResponse
     */
    public function sendData($data)
    {
        $response = [];
        return $this->createResponse($response->getElements());
    }

    /**
     * Create Generic Response from Xero Endpoint
     * @param mixed $data Array Elements or Xero Collection from Response
     * @return DeleteAccountResponse
     */
    public function createResponse($data)
    {
        return $this->response = new DeleteInventoryItemResponse($this, $data);
    }

    public function getEndpoint()
    {
        // TODO: Implement getEndpoint() method.
    }
}