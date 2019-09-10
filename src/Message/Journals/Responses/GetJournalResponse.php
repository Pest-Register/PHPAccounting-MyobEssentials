<?php


namespace PHPAccounting\MyobEssentials\Message\Journals\Responses;


use Omnipay\Common\Message\AbstractResponse;
use PHPAccounting\MyobEssentials\Helpers\IndexSanityCheckHelper;

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
                if (array_key_exists('account', $journalItem)) {
                    $newJournalItem['account_id'] = $journalItem['account']['uid'];
                }

                if (array_key_exists('taxType', $journalItem)) {
                    $newJournalItem['tax_type_id'] = $journalItem['taxType']['uid'];
                }
                $newJournalItem['credit'] = IndexSanityCheckHelper::indexSanityCheck('credit', $journalItem);
                $newJournalItem['description'] = IndexSanityCheckHelper::indexSanityCheck('description', $journalItem);
                $newJournalItem['line_amount'] = IndexSanityCheckHelper::indexSanityCheck('amount', $journalItem);
                $newJournalItem['tax_amount'] = IndexSanityCheckHelper::indexSanityCheck('taxAmount', $journalItem);
                $newJournalItem['is_credit'] = IndexSanityCheckHelper::indexSanityCheck('credit', $journalItem);
                array_push($journalItems, $newJournalItem);
            }

            $journal['journal_data'] = $journalItems;
        }
        return $journal;
    }
    /**
     * Return all Invoices with Generic Schema Variable Assignment
     * @return array
     */
    public function getJournals(){
        $journals = [];
        var_dump($this->data);
        foreach($this->data['items'] as $journal) {
            $newJournal = [];
            $newJournal['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('uid', $journal);;
            $newJournal['date'] = IndexSanityCheckHelper::indexSanityCheck('transactionDate', $journal);
            $newJournal['narration'] = IndexSanityCheckHelper::indexSanityCheck('notes', $journal);
            $newJournal['gst'] = IndexSanityCheckHelper::indexSanityCheck('gstInclusive', $journal);
            if (array_key_exists('journalEntries', $journal)) {
                $newJournal = $this->parseJournalItems($journal['journalEntries'], $newJournal);
            }


            array_push($journals, $newJournal);

        }

        return $journals;
    }

}