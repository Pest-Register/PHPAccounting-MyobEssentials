<?php
namespace PHPAccounting\MyobEssentials\Message\CurrentUser\Requests;

use PHPAccounting\MyobEssentials\Message\AbstractRequest;
use PHPAccounting\MyobEssentials\Message\CurrentUser\Responses\GetCurrentUserResponse;

/**
 * Get Contact(s)
 * @package PHPAccounting\MyobEssentials\Message\Contacts\Requests
 */
class GetCurrentUserRequest extends AbstractRequest
{
    public function getEndpoint()
    {

        $endpoint = 'CurrentUser/';

        return $endpoint;
    }

    public function getHttpMethod()
    {
        return 'GET';
    }

    protected function createResponse($data, $headers = [])
    {
        return $this->response = new GetCurrentUserResponse($this, $data);
    }
}