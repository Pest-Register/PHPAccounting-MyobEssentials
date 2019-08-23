<?php

namespace PHPAccounting\MyobEssentials\Message\Journals\Responses;

use Omnipay\Common\Message\AbstractResponse;
use PHPAccounting\MyobEssentials\Helpers\IndexSanityCheckHelper;

/**
 * Get Journal(s) Response
 * @package PHPAccounting\MyobEssentials\Message\Journals\Responses
 */
class GetJournalResponse extends AbstractResponse
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

    private function parseJournalItems($data, $journal) {
        if ($data) {
            $journalItems = [];
            foreach($data as $journalItem) {
                $newJournalItem = [];
                $newJournalItem['tax_amount'] = 0;
                $newJournalItem['gross_amount'] = 0;
                $newJournalItem['net_amount'] = 0;
                $newJournalItem['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('RowID', $journalItem);

                if (array_key_exists('Account', $journalItem)) {
                    $newJournalItem['account_id'] = IndexSanityCheckHelper::indexSanityCheck('UID', $journalItem['Account']);
                    $newJournalItem['account_code'] = IndexSanityCheckHelper::indexSanityCheck('DisplayID', $journalItem['Account']);
                    $newJournalItem['account_name'] = IndexSanityCheckHelper::indexSanityCheck('Name', $journalItem['Account']);
                }

                if (array_key_exists('TaxCode', $journalItem)) {
                    $newJournalItem['tax_type'] = IndexSanityCheckHelper::indexSanityCheck('Code', $journalItem['TaxCode']);
                }
                $newJournalItem['tax_amount'] = IndexSanityCheckHelper::indexSanityCheck('TaxAmount', $journalItem);
                $newJournalItem['gross_amount'] = IndexSanityCheckHelper::indexSanityCheck('Amount', $journalItem);
                $newJournalItem['net_amount'] = (float) $newJournalItem['tax_amount'] + (float) $newJournalItem['gross_amount'];

                array_push($journalItems, $newJournalItem);
            }

            $journal['journal_data'] = $journalItems;
        }
        return $journal;
    }

    /**
     * Return all Accounts with Generic Schema Variable Assignment
     * @return array
     */
    public function getJournals(){
        $journals = [];
        foreach ($this->data['Items'] as $journal) {
            $newJournal = [];
            $newJournal['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('UID', $journal);
            $newJournal['date'] = IndexSanityCheckHelper::indexSanityCheck('DateOccurred', $journal);
            $newJournal['reference_id'] = IndexSanityCheckHelper::indexSanityCheck('DisplayID', $journal);

            if (array_key_exists('SourceTransaction', $journal)) {
                if ($journal['SourceTransaction']) {
                    $newJournal['source_type'] = IndexSanityCheckHelper::indexSanityCheck('TransactionType', $journal['SourceTransaction']);
                    $newJournal['source_id'] = IndexSanityCheckHelper::indexSanityCheck('UID', $journal['SourceTransaction']);
                }

            }

            if (array_key_exists('Lines', $journal)) {
                if ($journal['Lines']) {
                    $newJournal = $this->parseJournalItems($journal['Lines'],$newJournal);
                }
            }
            array_push($journals, $newJournal);
        }

        return $journals;
    }
}