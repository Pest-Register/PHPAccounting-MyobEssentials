<?php
namespace PHPAccounting\MyobEssentials\Message\Contacts\Responses;

use Omnipay\Common\Message\AbstractResponse;
use PHPAccounting\MyobEssentials\Helpers\IndexSanityCheckHelper;

/**
 * Get Contact(s) Response
 * @package PHPAccounting\MyobEssentials\Message\Contacts\Responses
 */
class GetContactResponse extends AbstractResponse
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
    public function getErrorMessage()
    {
        if (array_key_exists('status', $this->data)) {
            return $this->data['detail'];
        }
        return null;
    }

    public function addPhone($contact, $data) {
        $newPhone = [];
        $newPhone['type'] = 'OTHER';
        $newPhone['phone_number'] = $data;
        array_push($contact, $newPhone);
    }


    public function parseAddressesAndPhones($contact, $data) {
        $contact['addresses'] = [];
        if ($data) {
            $addresses = [];
            foreach($data as $address) {
                $newAddress = [];
                $newAddress['address_type'] = 'EXTRA';
                $newAddress['address_line_1'] = IndexSanityCheckHelper::indexSanityCheck('Street', $address);
                $newAddress['city'] = IndexSanityCheckHelper::indexSanityCheck('City', $address);
                $newAddress['postal_code'] = IndexSanityCheckHelper::indexSanityCheck('PostCode', $address);
                $newAddress['country'] = IndexSanityCheckHelper::indexSanityCheck('Country', $address);

                if (array_key_exists('Phone1', $address)) {
                    $this->addPhone($contact, $address['Phone1']);
                }
                if (array_key_exists('Phone2', $address)) {
                    $this->addPhone($contact, $address['Phone2']);
                }
                if (array_key_exists('Phone3', $address)) {
                    $this->addPhone($contact, $address['Phone3']);
                }

                array_push($addresses, $newAddress);
            }
            $contact['addresses'] = $addresses;
        }

        return $contact;
    }
    /**
     * Return all Contacts with Generic Schema Variable Assignment
     * @return array
     */
    public function getContacts(){
        $contacts = [];
        foreach ($this->data['Items'] as $contact) {
            $newContact = [];
            $newContact['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('UID', $contact);
            $newContact['first_name'] = IndexSanityCheckHelper::indexSanityCheck('FirstName', $contact);
            $newContact['last_name'] = IndexSanityCheckHelper::indexSanityCheck('LastName', $contact);
            $newContact['display_name'] = IndexSanityCheckHelper::indexSanityCheck('DisplayID', $contact);
            $newContact['is_individual'] = IndexSanityCheckHelper::indexSanityCheck('IsIndividual', $contact);
            $newContact['type'] = IndexSanityCheckHelper::indexSanityCheck('Type', $contact);
            $newContact['updated_at'] = IndexSanityCheckHelper::indexSanityCheck('LastModified', $contact);

            if (array_key_exists('Addresses', $contact)) {
                $newContact = $this->parseAddressesAndPhones($newContact, $contact['Addresses']);
            }

            array_push($contacts, $newContact);
        }

        return $contacts;
    }
}