<?php

namespace PHPAccounting\MyobEssentials\Message\Payments\Responses;

use Omnipay\Common\Message\AbstractResponse;
use PHPAccounting\MyobEssentials\Helpers\IndexSanityCheckHelper;

/**
 * Create Invoice(s) Response
 * @package PHPAccounting\MyobEssentials\Message\Invoices\Responses
 */
class CreatePaymentResponse extends AbstractResponse
{
    /**
     * Check Response for Error or Success
     * @return boolean
     */
    public function isSuccessful()
    {
        if(array_key_exists('status', $this->data)){
            return !$this->data['status'] == 'error';
        }
        return true;
    }

    /**
     * Fetch Error Message from Response
     * @return string
     */
    public function getErrorMessage(){
        if(array_key_exists('status', $this->data)){
            return $this->data['detail'];
        }
        return null;
    }

    /**
     * Return all Payments with Generic Schema Variable Assignment
     * @return array
     */
    public function getPayments(){
        $payments = [];

        return $payments;
    }
}