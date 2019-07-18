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
     * Return all Accounts with Generic Schema Variable Assignment
     * @return array
     */
    public function getAccounts(){
        $accounts = [];
        foreach ($this->data['Items'] as $account) {
            $newAccount = [];
            $newAccount['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('UID', $account);
            $newAccount['code'] = IndexSanityCheckHelper::indexSanityCheck('Number', $account);
            $newAccount['name'] = IndexSanityCheckHelper::indexSanityCheck('Name', $account);
            $newAccount['description'] = IndexSanityCheckHelper::indexSanityCheck('Description', $account);
            $newAccount['type'] = IndexSanityCheckHelper::indexSanityCheck('Type', $account);

            if (array_key_exists('Type', $account)) {
                if ($account['Type']) {
                    $newAccount['is_bank_account'] = ($account['Type'] === 'Bank');
                }
            }

            if (array_key_exists('BankingDetails', $account)) {
                if ($account['BankingDetails']) {
                    $newAccount['bank_account_number'] = IndexSanityCheckHelper::indexSanityCheck('BankAccountNumber', $account['BankingDetails']);
                }
            }

            if (array_key_exists('TaxCode', $account)) {
                if ($account['TaxCode']) {
                    $newAccount['tax_type'] = IndexSanityCheckHelper::indexSanityCheck('Code', $account['TaxCode']);
                }
            }
            array_push($accounts, $newAccount);
        }

        return $accounts;
    }
}