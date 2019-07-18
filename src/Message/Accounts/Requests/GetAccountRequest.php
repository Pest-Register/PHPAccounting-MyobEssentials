<?php

namespace PHPAccounting\MyobEssentials\Message\Accounts\Requests;

use PHPAccounting\MyobEssentials\Helpers\BuildEndpointHelper;
use PHPAccounting\MyobEssentials\Helpers\IndexSanityCheckHelper;
use PHPAccounting\MyobEssentials\Message\AbstractRequest;
use PHPAccounting\MyobEssentials\Message\Accounts\Responses\GetAccountResponse;


/**
 * Get Account(s)
 * @package PHPAccounting\MyobEssentials\Message\Accounts\Requests
 */
class GetAccountRequest extends AbstractRequest
{

    /**
     * Set AccountingID from Parameter Bag (UID generic interface)
     * @param $value
     * @return GetAccountRequest
     */
    public function setAccountingID($value) {
        return $this->setParameter('accounting_id', $value);
    }

    /**
     * Set Page Value for Pagination from Parameter Bag
     * @param $value
     * @return GetAccountRequest
     */
    public function setPage($value) {
        return $this->setParameter('page', $value);
    }

    /**
     * Return Accounting IDs (UID)
     * @return mixed comma-delimited-string
     */
    public function getAccountingID() {
        if ($this->getParameter('accounting_id')) {
            return $this->getParameter('accounting_id');
        }
        return null;
    }

    /**
     * Return Page Value for Pagination
     * @return integer
     */
    public function getPage() {
        if ($this->getParameter('page')) {
            return $this->getParameter('page');
        }

        return 1;
    }

    public function getEndpoint()
    {

        $endpoint = 'GeneralLedger/Account/';

        if ($this->getAccountingID()) {
            if ($this->getAccountingID() !== "") {
                $endpoint = BuildEndpointHelper::loadByGUID($endpoint, $this->getAccountingID());
            }
        } else {
            if ($this->getPage()) {
                if ($this->getPage() !== "") {
                    $endpoint = BuildEndpointHelper::paginate($endpoint, $this->getPage());
                }
            }
        }
        return $endpoint;
    }

    public function getHttpMethod()
    {
        return 'GET';
    }

    protected function createResponse($data, $headers = [])
    {
        return $this->response = new GetAccountResponse($this, $data);
    }

}