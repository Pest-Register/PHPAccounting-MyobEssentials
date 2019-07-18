<?php
namespace PHPAccounting\MyobEssentials\Message\Organisations\Requests;

use PHPAccounting\MyobEssentials\Message\AbstractRequest;
use PHPAccounting\MyobEssentials\Message\Organisations\Responses\GetOrganisationResponse;
/**
 * Get Contact(s)
 * @package PHPAccounting\MyobEssentials\Message\Contacts\Requests
 */
class GetOrganisationRequest extends AbstractRequest
{
    public function setCompanyEndpoint($value)
    {
        return $this->setParameter('companyEndpoint','https://api.myob.com/accountright/');
    }

    public function getHttpMethod()
    {
        return 'GET';
    }

    protected function createResponse($data, $headers = [])
    {
        return $this->response = new GetOrganisationResponse($this, $data);
    }

    public function getEndpoint()
    {
        return '';
    }
}