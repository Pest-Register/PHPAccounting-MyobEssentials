<?php

namespace PHPAccounting\MyobEssentials;

use Omnipay\Common\AbstractGateway;

/**
 * Created by IntelliJ IDEA.
 * User: Dylan
 * Date: 13/05/2019
 * Time: 3:11 PM
 * @method \PhpAccounting\Common\Message\NotificationInterface acceptNotification(array $options = array())
 * @method \PhpAccounting\Common\Message\RequestInterface authorize(array $options = array())
 * @method \PhpAccounting\Common\Message\RequestInterface completeAuthorize(array $options = array())
 * @method \PhpAccounting\Common\Message\RequestInterface capture(array $options = array())
 * @method \PhpAccounting\Common\Message\RequestInterface purchase(array $options = array())
 * @method \PhpAccounting\Common\Message\RequestInterface completePurchase(array $options = array())
 * @method \PhpAccounting\Common\Message\RequestInterface refund(array $options = array())
 * @method \PhpAccounting\Common\Message\RequestInterface fetchTransaction(array $options = [])
 * @method \PhpAccounting\Common\Message\RequestInterface void(array $options = array())
 * @method \PhpAccounting\Common\Message\RequestInterface createCard(array $options = array())
 * @method \PhpAccounting\Common\Message\RequestInterface updateCard(array $options = array())
 * @method \PhpAccounting\Common\Message\RequestInterface deleteCard(array $options = array())
 */

class Gateway extends AbstractGateway
{

    /**
     * Get gateway display name
     *
     * This can be used by carts to get the display name for each gateway.
     * @return string
     */
    public function getName()
    {
        return 'Myob';
    }

    /**
     * Access Token getters and setters
     * @return mixed
     */

    public function getAccessToken()
    {
        return $this->getParameter('accessToken');
    }

    public function setAccessToken($value)
    {
        return $this->setParameter('accessToken', $value);
    }

    /**
     * API Key getters and setters
     * @return mixed
     */

    public function getAPIKey()
    {
        return $this->getParameter('APIKey');
    }

    public function setAPIKey($value)
    {
        return $this->setParameter('APIKey', $value);
    }

    /**
     * Country Code getters and setters
     * @return mixed
     */

    public function getCountryCode()
    {
        return $this->getParameter('countryCode');
    }

    public function setCountryCode($value)
    {
        return $this->setParameter('countryCode', $value);
    }

    /**
     * Business ID getters and setters
     * @return mixed
     */

    public function getBusinessID()
    {
        return $this->getParameter('businessID');
    }

    public function setBusinessID($value)
    {
        return $this->setParameter('businessID', $value);
    }


    /**
     * Customer Requests
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */

    public function createContact(array $parameters = []){
        return $this->createRequest('\PHPAccounting\MyobEssentials\Message\Contacts\Requests\CreateContactRequest', $parameters);
    }

    public function updateContact(array $parameters = []){
        return $this->createRequest('\PHPAccounting\MyobEssentials\Message\Contacts\Requests\UpdateContactRequest', $parameters);
    }

    /**
     * Get One or Multiple Contacts
     * @param array $parameters
     * @bodyParam array $parameters
     * @bodyParam parameters.page int optional Page Index for Pagination
     * @bodyParam parameters.accountingIDs array optional Array of GUIDs for Contact Retrieval / Filtration
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function getContact(array $parameters = []){
        return $this->createRequest('\PHPAccounting\MyobEssentials\Message\Contacts\Requests\GetContactRequest', $parameters);
    }

    public function deleteContact(array $parameters = []){
        return $this->createRequest('\PHPAccounting\MyobEssentials\Message\Contacts\Requests\DeleteContactRequest', $parameters);
    }


    /**
     * Invoice Requests
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */

    public function createInvoice(array $parameters = []){
        return $this->createRequest('\PHPAccounting\MyobEssentials\Message\Invoices\Requests\CreateInvoiceRequest', $parameters);
    }

    public function updateInvoice(array $parameters = []){
        return $this->createRequest('\PHPAccounting\MyobEssentials\Message\Invoices\Requests\UpdateInvoiceRequest', $parameters);
    }

    public function getInvoice(array $parameters = []){
        return $this->createRequest('\PHPAccounting\MyobEssentials\Message\Invoices\Requests\GetInvoiceRequest', $parameters);
    }

    public function deleteInvoice(array $parameters = []){
        return $this->createRequest('\PHPAccounting\MyobEssentials\Message\Invoices\Requests\DeleteInvoiceRequest', $parameters);
    }

    /**
     * Account Requests
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */

    public function createAccount(array $parameters = []){
        return $this->createRequest('\PHPAccounting\MyobEssentials\Message\Accounts\Requests\CreateAccountRequest', $parameters);
    }

    public function updateAccount(array $parameters = []){
        return $this->createRequest('\PHPAccounting\MyobEssentials\Message\Accounts\Requests\UpdateAccountRequest', $parameters);
    }

    public function getAccount(array $parameters = []){
        return $this->createRequest('\PHPAccounting\MyobEssentials\Message\Accounts\Requests\GetAccountRequest', $parameters);
    }

    public function deleteAccount(array $parameters = []){
        return $this->createRequest('\PHPAccounting\MyobEssentials\Message\Accounts\Requests\DeleteAccountRequest', $parameters);
    }

    /**
     * Payment Requests
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */

    public function createPayment(array $parameters = []){
        return $this->createRequest('\PHPAccounting\MyobEssentials\Message\Payments\Requests\CreatePaymentRequest', $parameters);
    }

    public function updatePayment(array $parameters = []){
        return $this->createRequest('\PHPAccounting\MyobEssentials\Message\Payments\Requests\UpdatePaymentRequest', $parameters);
    }

    public function getPayment(array $parameters = []){
        return $this->createRequest('\PHPAccounting\MyobEssentials\Message\Payments\Requests\GetPaymentRequest', $parameters);
    }

    public function deletePayment(array $parameters = []){
        return $this->createRequest('\PHPAccounting\MyobEssentials\Message\Payments\Requests\DeletePaymentRequest', $parameters);
    }

    /**
     * Organisation Requests
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */

    public function getOrganisation(array $parameters = []){
        return $this->createRequest('\PHPAccounting\MyobEssentials\Message\Organisations\Requests\GetOrganisationRequest', $parameters);
    }

    /**
     * CurrentUser Requests
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */

    public function getCurrentUser(array $parameters = []){
        return $this->createRequest('\PHPAccounting\MyobEssentials\Message\CurrentUser\Requests\GetCurrentUserRequest', $parameters);
    }

    /**
     * Journal Requests
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */

    public function createJournal(array $parameters = []){
        return $this->createRequest('\PHPAccounting\MyobEssentials\Message\Journals\Requests\CreateJournalRequest', $parameters);
    }

    public function updateJournal(array $parameters = []){
        return $this->createRequest('\PHPAccounting\MyobEssentials\Message\Journals\Requests\UpdateJournalRequest', $parameters);
    }

    public function getJournal(array $parameters = []){
        return $this->createRequest('\PHPAccounting\MyobEssentials\Message\Journals\Requests\GetJournalRequest', $parameters);
    }

    public function deleteJournal(array $parameters = []){
        return $this->createRequest('\PHPAccounting\MyobEssentials\Message\Journals\Requests\DeleteJournalRequest', $parameters);
    }

    /**
     * InventoryItem Requests
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */

    public function createInventoryItem(array $parameters = []){
        return $this->createRequest('\PHPAccounting\MyobEssentials\Message\InventoryItems\Requests\CreateInventoryItemRequest', $parameters);
    }

    public function updateInventoryItem(array $parameters = []){
        return $this->createRequest('\PHPAccounting\MyobEssentials\Message\InventoryItems\Requests\UpdateInventoryItemRequest', $parameters);
    }

    public function getInventoryItem(array $parameters = []){
        return $this->createRequest('\PHPAccounting\MyobEssentials\Message\InventoryItems\Requests\GetInventoryItemsRequest', $parameters);
    }

    public function deleteInventoryItem(array $parameters = []){
        return $this->createRequest('\PHPAccounting\MyobEssentials\Message\InventoryItems\Requests\DeleteInventoryItemRequest', $parameters);
    }
}