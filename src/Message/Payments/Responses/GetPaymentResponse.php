<?php

namespace PHPAccounting\MyobEssentials\Message\Payments\Responses;

use Omnipay\Common\Message\AbstractResponse;
use PHPAccounting\MyobEssentials\Helpers\IndexSanityCheckHelper;

/**
 * Get Invoice(s) Response
 * @package PHPAccounting\MyobEssentials\Message\Invoices\Responses
 */
class GetPaymentResponse extends AbstractResponse
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
     * Add Invoice to Payment
     * @param $data Array of single Contact
     * @param array $payment Xero Invoice Object Mapping
     * @return mixed
     */
    private function parseInvoices($payment, $data) {
        if ($data) {
            $payment['invoice'] = [];
            foreach ($data as $invoice) {
                $newInvoice = [];
                $newInvoice['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('UID', $invoice);
                $newInvoice['type'] = IndexSanityCheckHelper::indexSanityCheck('Type', $invoice);
                $newInvoice['invoice_number'] = IndexSanityCheckHelper::indexSanityCheck('Number', $invoice);
                array_push($payment['invoice'],$newInvoice);
            }

        }

        return $payment;
    }

    /**
     * Add Account to Payment
     * @param $data Array of single Contact
     * @param array $payment Xero Invoice Object Mapping
     * @return mixed
     */
    private function parseAccount($payment, $data) {
        if ($data) {
            $newAccount = [];
            $newAccount['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('UID', $data);
            $newAccount['code'] = IndexSanityCheckHelper::indexSanityCheck('DisplayID', $data);
            $payment['account'] = $newAccount;
        }

        return $payment;
    }

    /**
     * Return all Invoices with Generic Schema Variable Assignment
     * @return array
     */
    public function getPayments(){
        $payments = [];
        foreach ($this->data['Items'] as $payment) {
            $newPayment = [];
            $newPayment['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('UID', $payment);
            $newPayment['date'] = IndexSanityCheckHelper::indexSanityCheck('Date', $payment);
            $newPayment['amount'] = IndexSanityCheckHelper::indexSanityCheck('AmountReceived', $payment);
            $newPayment['reference_id'] = IndexSanityCheckHelper::indexSanityCheck('Memo', $payment);
            $newPayment['type'] = IndexSanityCheckHelper::indexSanityCheck('PaymentMethod', $payment);

            if (array_key_exists('Account', $payment)) {
                if ($payment['Account']) {
                    $newPayment = $this->parseAccount($newPayment, $payment['Account']);
                }
            }

            if (array_key_exists('Invoices', $payment)) {
                if ($payment['Invoices']) {
                    $newPayment = $this->parseInvoices($newPayment, $payment['Invoices']);
                }
            }


            if (array_key_exists('ReceiptNumber', $payment)) {
                if ($payment['ReceiptNumber']) {
                    $newPayment['is_reconciled'] = true;
                }
            }
            array_push($payments, $newPayment);
        }

        return $payments;
    }
}