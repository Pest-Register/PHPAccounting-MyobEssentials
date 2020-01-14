<?php

namespace PHPAccounting\MyobEssentials\Message\Accounts\Responses;

use Omnipay\Common\Message\AbstractResponse;
use PHPAccounting\MyobEssentials\Helpers\IndexSanityCheckHelper;

/**
 * Create Account(s) Response
 * @package PHPAccounting\MyobEssentials\Message\ContactGroups\Responses
 */
class CreateAccountResponse extends AbstractResponse
{
    /**
     * Check Response for Error or Success
     * @return boolean
     */
    public function isSuccessful()
    {
        if ($this->data) {
            if(array_key_exists('errors', $this->data)){
                return false;
            }
        } else {
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
        if ($this->data) {
            if (array_key_exists('errors', $this->data)) {
                if ($this->data['errors'][0]['message'] === 'Invalid authentication token.') {
                    return 'The access token has expired';
                }
                elseif (strpos($this->data['errors'][0]['message'], 'page not found') !== false) {
                    return 'End of Pagination';
                }
            }
        } else {
            return 'NULL returned from API';
        }

        return null;
    }

    /**
     * Return all Invoices with Generic Schema Variable Assignment
     * @return array
     */
    public function getAccounts(){
        $accounts = [];
        $account = $this->data;
        $newAccount = [];
        $newAccount['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('uid', $account);
        array_push($accounts, $newAccount);
        return $accounts;
    }
}