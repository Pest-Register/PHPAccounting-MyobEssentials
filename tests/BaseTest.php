<?php
namespace Tests;


use Dotenv\Dotenv;
use Omnipay\Omnipay;
use PHPUnit\Framework\TestCase;

class BaseTest extends TestCase
{
    public $gateway;

    public function setUp()
    {
        parent::setUp();
        $dotenv = Dotenv::create(__DIR__ . '/..');
        $dotenv->load();
        $this->gateway = Omnipay::create('\PHPAccounting\MyobEssentials\Gateway');

        $this->gateway->setAPIKey(getenv('API_KEY'));
        $this->gateway->setAccessToken(getenv('ACCESS_TOKEN'));
        $this->gateway->setCompanyEndpoint(getenv('COMPANY_FILE_URI'));
        $this->gateway->setCompanyFile(base64_encode('Administrator:'));
    }

}