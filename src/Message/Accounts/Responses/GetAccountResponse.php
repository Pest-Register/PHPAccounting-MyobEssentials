<?php

namespace PHPAccounting\MyobEssentials\Message\Accounts\Responses;

use Omnipay\Common\Message\AbstractResponse;
use PHPAccounting\MyobEssentials\Helpers\IndexSanityCheckHelper;

/**
 * Get ContactGroup(s) Response
 * @package PHPAccounting\MyobEssentials\Message\ContactGroups\Responses
 */
class GetAccountResponse extends AbstractResponse
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
     * Return all Accounts with Generic Schema Variable Assignment
     * @return array
     */
    public function getAccounts(){
        $accounts = [];
        foreach ($this->data['items'] as $account) {
            $newAccount = [];
            $newAccount['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('uid', $account);
            $newAccount['code'] = IndexSanityCheckHelper::indexSanityCheck('displayId', $account);
            $newAccount['name'] = IndexSanityCheckHelper::indexSanityCheck('name', $account);


            if (array_key_exists('type', $account)) {
                if ($account['type']) {
                    $newAccount['type'] = IndexSanityCheckHelper::indexSanityCheck('name', $account['type']);
                    $newAccount['is_bank_account'] = ($account['type'] === 'Banking');
                }
            }

            if (array_key_exists('taxType', $account)) {
                if ($account['taxType']) {
                    $newAccount['tax_type'] = IndexSanityCheckHelper::indexSanityCheck('code', $account['taxType']);
                }
            }
            array_push($accounts, $newAccount);
        }

        return $accounts;
    }
}