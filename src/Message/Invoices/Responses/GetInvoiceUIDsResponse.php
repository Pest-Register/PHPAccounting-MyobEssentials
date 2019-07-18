<?php


namespace PHPAccounting\MyobEssentials\Message\Invoices\Responses;


use Omnipay\Common\Message\AbstractResponse;
use PHPAccounting\MyobEssentials\Helpers\IndexSanityCheckHelper;

class GetInvoiceUIDsResponse extends AbstractResponse
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
     * Return all Invoices with Generic Schema Variable Assignment
     * @return array
     */
    public function getInvoiceUIDs(){
        $invoices = [];
        foreach ($this->data['Items'] as $invoice) {
            $newInvoice = [];
            $newInvoice['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('UID', $invoice);
            $newInvoice['URI'] = IndexSanityCheckHelper::indexSanityCheck('URI', $invoice);
            if (array_key_exists('URI', $invoice)) {
                $splitURI = explode('/', $invoice['URI']);
                array_pop($splitURI);
                $newInvoice['URI'] = implode('/', $splitURI);
                $newInvoice['URI'] = strstr($newInvoice['URI'], '/Sale');
            }


            array_push($invoices, $newInvoice);
        }

        return $invoices;
    }
    
}