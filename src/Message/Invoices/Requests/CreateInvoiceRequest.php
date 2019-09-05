<?php

namespace PHPAccounting\MyobEssentials\Message\Invoices\Requests;

use PHPAccounting\MyobEssentials\Helpers\IndexSanityCheckHelper;
use PHPAccounting\MyobEssentials\Helpers\IndexSanityInsertionHelper;
use PHPAccounting\MyobEssentials\Message\AbstractRequest;
use PHPAccounting\MyobEssentials\Message\InventoryItems\Responses\CreateInventoryItemResponse;
use PHPAccounting\MyobEssentials\Message\Invoices\Responses\CreateInvoiceResponse;

/**
 * Create Invoice
 * @package PHPAccounting\MyobEssentials\Message\Invoices\Requests
 */
class CreateInvoiceRequest extends AbstractRequest
{
    /**
     * Get GST Registered Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/sale/invoices
     * @return mixed
     */
    public function getGSTRegistered(){
        return $this->getParameter('gst_registered');
    }

    /**
     * Set GST Registered Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/sale/invoices
     * @param string $value Invoice Type
     * @return CreateInvoiceRequest
     */
    public function setGSTRegistered($value){
        return $this->setParameter('gst_registered', $value);
    }
    /**
     * Get Invoice Reference Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/sale/invoices
     * @return mixed
     */
    public function getInvoiceReference(){
        return $this->getParameter('invoice_reference');
    }

    /**
     * Set Invoice Reference Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/sale/invoices
     * @param string $value Invoice Type
     * @return CreateInvoiceRequest
     */
    public function setInvoiceReference($value){
        return $this->setParameter('invoice_reference', $value);
    }

    /**
     * Get Type Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/sale/invoices
     * @return mixed
     */
    public function getType(){
        return $this->getParameter('type');
    }

    /**
     * Set Type Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/sale/invoices
     * @param string $value Invoice Type
     * @return CreateInvoiceRequest
     */
    public function setType($value){
        return $this->setParameter('type', $value);
    }


    /**
     * Get Status Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/sale/invoices
     * @return mixed
     */
    public function getStatus(){
        return $this->getParameter('status');
    }

    /**
     * Set Status Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/sale/invoices
     * @param string $value Invoice Type
     * @return CreateInvoiceRequest
     */
    public function setStatus($value){
        return $this->setParameter('status', $value);
    }

    /**
     * Get Total Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/sale/invoices
     * @return mixed
     */
    public function getTotal(){
        return $this->getParameter('total');
    }

    /**
     * Set Total Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/sale/invoices
     * @param string $value Invoice Type
     * @return CreateInvoiceRequest
     */
    public function setTotal($value){
        return $this->setParameter('total', $value);
    }


    /**
     * Get Invoice Data Parameter from Parameter Bag (LineItems generic interface)
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/sale/invoices
     * @return mixed
     */
    public function getInvoiceData(){
        return $this->getParameter('invoice_data');
    }

    /**
     * Set Invoice Data Parameter from Parameter Bag (LineItems)
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/sale/invoices
     * @param array $value Invoice Item Lines
     * @return CreateInvoiceRequest
     */
    public function setInvoiceData($value){
        return $this->setParameter('invoice_data', $value);
    }

    /**
     * Get Date Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/sale/invoices
     * @return mixed
     */
    public function getDate(){
        return $this->getParameter('date');
    }

    /**
     * Set Date Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/sale/invoices
     * @param string $value Invoice date
     * @return CreateInvoiceRequest
     */
    public function setDate($value){
        return $this->setParameter('date', $value);
    }

    /**
     * Get Due Date Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/sale/invoices
     * @return mixed
     */
    public function getDueDate(){
        return $this->getParameter('due_date');
    }

    /**
     * Set Due Date Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/sale/invoices
     * @param string $value Invoice Due Date
     * @return CreateInvoiceRequest
     */
    public function setDueDate($value){
        return $this->setParameter('due_date', $value);
    }

    /**
     * Get Contact Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/sale/invoices
     * @return mixed
     */
    public function getContact(){
        return $this->getParameter('contact');
    }

    /**
     * Set Contact Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/sale/invoices
     * @return CreateInvoiceRequest
     */
    public function setContact($value){
        return $this->setParameter('contact', $value);
    }

    /**
     * Get GST Inclusive Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/sale/invoices
     * @return mixed
     */
    public function getGSTInclusive(){
        return $this->getParameter('gst_inclusive');
    }

    /**
     * Set GST Inclusive Parameter from Parameter Bag
     * @see https://developer.myob.com/api/essentials-accounting/endpoints/sale/invoices
     * @return CreateInvoiceRequest
     */
    public function setGSTInclusive($value){
        return $this->setParameter('gst_inclusive', $value);
    }

    private function parseLines($lines, $gst, $data) {
        $data['lines'] = [];
        if ($lines) {
            foreach($lines as $line) {
                $newLine = [];
                $newLine['account'] = [];
                $newLine['item'] = [];
                $newLine['taxType'] = [];
                if ($gst) {
                    $newLine['taxType']['uid'] = IndexSanityCheckHelper::indexSanityCheck('tax_id', $line);
                }
                else {
                    $newLine['taxType']['uid'] = '';
                }

                $newLine['unitOfMeasure'] = IndexSanityCheckHelper::indexSanityCheck('unit', $line);
                $newLine['description'] = IndexSanityCheckHelper::indexSanityCheck('description', $line);
                $newLine['quantity'] = IndexSanityCheckHelper::indexSanityCheck('quantity', $line);
                $newLine['unitPrice'] = IndexSanityCheckHelper::indexSanityCheck('unit_amount', $line);
                $newLine['account']['uid'] = IndexSanityCheckHelper::indexSanityCheck('account_id', $line);
                $newLine['item']['uid'] = IndexSanityCheckHelper::indexSanityCheck('item_id', $line);
                array_push($data['lines'], $newLine);
            }
        }
        return $data;
    }
    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('contact', 'invoice_data', 'gst_registered', 'gst_inclusive');

        $this->issetParam('issueDate', 'date');
        $this->issetParam('dueDate', 'due_date');
        $this->issetParam('invoiceNumber', 'invoice_reference');
        $this->issetParam('status', 'status');
        $this->issetParam('total', 'total');
        $this->issetParam('gstInclusive', 'gst_inclusive');
        if ($this->getInvoiceData() !== null && $this->getGSTRegistered() !== null) {
            $gst = $this->getGSTRegistered();
            $this->data = $this->parseLines($this->getInvoiceData(),$gst, $this->data);
        }
        if ($this->getContact() !== null) {
            $this->data['contact'] = [];
            $this->data['contact']['uid'] = $this->getContact();
        }

        return $this->data;
    }

    public function getEndpoint()
    {

        $endpoint = 'sale/invoices';
        return $endpoint;
    }

    public function getHttpMethod()
    {
        return 'POST';
    }

    protected function createResponse($data, $headers = [])
    {
        return $this->response = new CreateInvoiceResponse($this, $data);
    }
}