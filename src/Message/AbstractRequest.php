<?php
namespace PHPAccounting\MyobEssentials\Message;

use Omnipay\Common\Message\ResponseInterface;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    /**
     * Live or Test Endpoint URL.
     *
     * @var string URL
     */
    protected $data = [];
    protected $version = 'v2';

    /**
     * Get Access Token
     */

    public function getAccessToken(){
        return $this->getParameter('accessToken');
    }

    public function setAccessToken($value){
        return $this->setParameter('accessToken', $value);
    }

    public function getCompanyEndpoint() {
        return $this->getParameter('companyEndpoint');
    }

    public function setCompanyEndpoint($value) {
        return $this->setParameter('companyEndpoint', $value);
    }

    public function getCompanyFile() {
        return $this->getParameter('companyFile');
    }

    public function setCompanyFile($value) {
        return $this->setParameter('companyFile',$value);
    }

    public function getAPIKey() {
        return $this->getParameter('apiKey');
    }

    public function setAPIKey($value) {
        return $this->setParameter('apiKey',$value);
    }

    abstract public function getEndpoint();

    /**
     * Check if key exists in param bag and add it to array
     * @param $myobKey
     * @param $localKey
     */
    public function issetParam($myobKey, $localKey){
        if(array_key_exists($localKey, $this->getParameters())){
            $this->data[$myobKey] = $this->getParameter($localKey);
        }
    }

    /**
     * Get HTTP Method.
     *
     * This is nearly always POST but can be over-ridden in sub classes.
     *
     * @return string
     */
    public function getHttpMethod()
    {
        return 'POST';
    }
    /**
     * @return array
     */
    /**
     * @return array
     */
    public function getHeaders()
    {
        $headers = array();
        if ($this->getCompanyFile()) {
            $headers['x-myobapi-cftoken'] = $this->getCompanyFile();
        }
        if ($this->getAPIKey()) {
            $headers['x-myobapi-key'] = $this->getAPIKey();
        }

        if ($this->getAccessToken()) {
            $headers['Authorization'] = 'Bearer '.$this->getAccessToken();
        }

        $headers['x-myobapi-version'] = $this->version;
        $headers['Accept-Encoding'] = 'gzip,deflate';

        return $headers;
    }

    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     */
    public function getData()
    {
        // TODO: Implement getData() method.
    }

    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     * @return ResponseInterface
     */
    public function sendData($data)
    {
        $endpoint = $this->getCompanyEndpoint();
        $headers = $this->getHeaders();
        $body = $data ? http_build_query($data, '', '&') : null;
        $httpResponse = $this->httpClient->request($this->getHttpMethod(), $endpoint . $this->getEndpoint(), $headers, $body);
        return $this->createResponse(json_decode($httpResponse->getBody()->getContents(), true), $httpResponse->getHeaders());
    }

    protected function createResponse($data, $headers = [])
    {
        return $this->response = new Response($this, $data, $headers);
    }
}