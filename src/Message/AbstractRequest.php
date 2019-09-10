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
    protected $version = 'v0';

    /**
     * Get Access Token
     */

    public function getAccessToken(){
        return $this->getParameter('accessToken');
    }

    public function setAccessToken($value){
        return $this->setParameter('accessToken', $value);
    }

    public function getBusinessID() {
        return $this->getParameter('businessID');
    }

    public function setBusinessID($value) {
        return $this->setParameter('businessID', $value);
    }

    public function getCountryCode() {
        return $this->getParameter('countryCode');
    }

    public function setCountryCode($value) {
        return $this->setParameter('countryCode', $value);
    }

    public function getAPIKey() {
        return $this->getParameter('apiKey');
    }

    public function setAPIKey($value) {
        return $this->setParameter('apiKey',$value);
    }

    public function setBusinessEndpoint($value) {
        return $this->setParameter('businessEndpoint', $value);
    }

    public function getBusinessEndpoint() {
        return $this->getParameter('businessEndpoint');
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
    public function getHeaders($httpMethod)
    {
        $headers = array();
        if ($this->getAPIKey()) {
            $headers['x-myobapi-key'] = $this->getAPIKey();
        }

        if ($this->getAccessToken()) {
            $headers['Authorization'] = 'Bearer '.$this->getAccessToken();
        }

        $headers['x-myobapi-version'] = $this->version;
        $headers['Accept-Encoding'] = 'gzip,deflate';

        if ($httpMethod === 'POST' || $httpMethod === 'PUT') {
            $headers['Content-Type'] = 'application/json';
        }


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
        if ($this->getBusinessID() !== '') {
            $endpoint = 'https://api.myob.com/'. $this->getCountryCode().'/essentials/'. $this->getBusinessID().'/';
        } else {
            $endpoint = 'https://api.myob.com/'. $this->getCountryCode().'/essentials/';
        }

        $headers = $this->getHeaders($this->getHttpMethod());
        $body = json_encode($data);
        var_dump($endpoint.$this->getEndpoint());
        $httpResponse = $this->httpClient->request($this->getHttpMethod(), $endpoint . $this->getEndpoint(), $headers, $body);

        $this->createResponse(json_decode($httpResponse->getBody()->getContents(), true), $httpResponse->getHeaders());
        return $this->response;
    }

    protected function createResponse($data, $headers = [])
    {
        return $this->response = new Response($this, $data, $headers);
    }
}