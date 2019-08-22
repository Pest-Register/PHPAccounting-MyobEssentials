<?php
namespace PHPAccounting\MyobEssentials\Message\Organisations\Responses;

use Omnipay\Common\Message\AbstractResponse;
use PHPAccounting\MyobEssentials\Helpers\IndexSanityCheckHelper;

/**
 * Get Organisation(s) Response
 * @package PHPAccounting\MyobEssentials\Message\Organisations\Responses
 */
class GetOrganisationResponse extends AbstractResponse
{

    /**
     * Check Response for Error or Success
     * @return boolean
     */
    public function isSuccessful()
    {
        if(array_key_exists('errors', $this->data)){
            return false;
        }
        return true;
    }

    /**
     * Fetch Error Message from Response
     * @return string
     */
    public function getErrorMessage()
    {
        if (array_key_exists('errors', $this->data)) {
            if ($this->data['errors'][0]['message'] === 'Invalid authentication token.') {
                return 'The access token has expired';
            }
            else {
                return $this->data['errors'][0]['message'];
            }
        }
        return null;
    }


    /**
     * Return all Contacts with Generic Schema Variable Assignment
     * @return array
     */
    public function getOrganisations(){
        $organisations = [];
        foreach ($this->data['items'] as $organisation) {
            $newOrganisation = [];
            $newOrganisation['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('uid', $organisation);
            $newOrganisation['name'] = IndexSanityCheckHelper::indexSanityCheck('name', $organisation);
            $newOrganisation['uri'] = IndexSanityCheckHelper::indexSanityCheck('uri', $organisation);
            $newOrganisation['country_code'] = IndexSanityCheckHelper::indexSanityCheck('country', $organisation);
            array_push($organisations, $newOrganisation);
        }

        return $organisations;
    }
}