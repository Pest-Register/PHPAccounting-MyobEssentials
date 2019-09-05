<?php

namespace PHPAccounting\MyobEssentials\Message\Invoices\Requests;

use PHPAccounting\MyobEssentials\Helpers\BuildEndpointHelper;
use PHPAccounting\MyobEssentials\Message\AbstractRequest;
use PHPAccounting\MyobEssentials\Message\Contacts\Responses\DeleteContactResponse;
use PHPAccounting\MyobEssentials\Message\Invoices\Responses\DeleteInvoiceResponse;

/**
 * Delete Invoice
 * @package PHPAccounting\MyobEssentials\Message\Invoices\Requests
 */
class DeleteInvoiceRequest extends AbstractRequest
{

    /**
     * Set AccountingID from Parameter Bag (UID generic interface)
     * @param $value
     * @return DeleteInvoiceRequest
     */
    public function setAccountingID($value) {
        return $this->setParameter('accounting_id', $value);
    }

    /**
     * Return Accounting ID (UID)
     * @return mixed comma-delimited-string
     */
    public function getAccountingID() {
        if ($this->getParameter('accounting_id')) {
            return $this->getParameter('accounting_id');
        }
        return null;
    }

    public function getData()
    {
        $this->issetParam('uid', 'accounting_id');
        return $this->data;
    }

    public function getEndpoint()
    {

        $endpoint = 'sale/invoices';

        if ($this->getAccountingID()) {
            if ($this->getAccountingID() !== "") {
                $endpoint = BuildEndpointHelper::createForGUID($endpoint, $this->getAccountingID());
            }
        }
        return $endpoint;
    }

    public function getHttpMethod()
    {
        return 'DELETE';
    }

    protected function createResponse($data, $headers = [])
    {
        return $this->response = new DeleteInvoiceResponse($this, $data);
    }

}