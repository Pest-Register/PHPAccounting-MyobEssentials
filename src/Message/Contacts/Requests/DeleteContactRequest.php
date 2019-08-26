<?php
namespace PHPAccounting\MyobEssentials\Message\Contacts\Requests;

use PHPAccounting\MyobEssentials\Helpers\BuildEndpointHelper;
use PHPAccounting\MyobEssentials\Message\AbstractRequest;
use PHPAccounting\MyobEssentials\Message\Contacts\Responses\DeleteContactResponse;
use PHPAccounting\MyobEssentials\Message\Contacts\Responses\GetContactResponse;
/**
 * Delete Contact(s)
 * @package PHPAccounting\MyobEssentials\Message\Contacts\Requests
 */
class DeleteContactRequest extends AbstractRequest
{
    /**
     * Set AccountingID from Parameter Bag (UID generic interface)
     * @param $value
     * @return DeleteContactRequest
     */
    public function setAccountingID($value) {
        return $this->setParameter('accounting_id', $value);
    }

    /**
     * Set Page Value for Pagination from Parameter Bag
     * @param $value
     * @return DeleteContactRequest
     */
    public function setPage($value) {
        return $this->setParameter('page', $value);
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

    public function getEndpoint()
    {

        $endpoint = 'contacts';

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
        return $this->response = new DeleteContactResponse($this, $data);
    }

}