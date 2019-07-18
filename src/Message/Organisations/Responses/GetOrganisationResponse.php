<?php
namespace PHPAccounting\MyobEssentials\Message\Organisations\Responses;

use Omnipay\Common\Message\AbstractResponse;
use PHPAccounting\MyobEssentials\Helpers\IndexSanityCheckHelper;

/**
 * Get Contact(s) Response
 * @package PHPAccounting\MyobEssentials\Message\Contacts\Responses
 */
class GetOrganisationResponse extends AbstractResponse
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


    /**
     * Return all Contacts with Generic Schema Variable Assignment
     * @return array
     */
    public function getOrganisations(){
        $organisations = [];
        foreach ($this->data as $organisation) {
            $newOrganisation = [];
            $newOrganisation['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('Id', $organisation);
            $newOrganisation['name'] = IndexSanityCheckHelper::indexSanityCheck('Name', $organisation);
            $newOrganisation['uri'] = IndexSanityCheckHelper::indexSanityCheck('Uri', $organisation);
            $newOrganisation['country_code'] = IndexSanityCheckHelper::indexSanityCheck('Country', $organisation);
            array_push($organisations, $newOrganisation);
        }

        return $organisations;
    }
}