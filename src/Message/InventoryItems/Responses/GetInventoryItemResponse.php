<?php

namespace PHPAccounting\MyobEssentials\Message\InventoryItems\Responses;

use Omnipay\Common\Message\AbstractResponse;
use PHPAccounting\MyobEssentials\Helpers\IndexSanityCheckHelper;

/**
 * Get InventoryItems(s) Response
 * @package PHPAccounting\MyobEssentials\Message\InventoryItems\Responses
 */
class GetInventoryItemResponse extends AbstractResponse
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
    public function getInventoryItems(){
        $items = [];
        if (array_key_exists('items', $this->data)) {
            foreach ($this->data['items'] as $item) {
                $newItem = [];
                $newItem['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('uid', $item);
                $newItem['code'] = IndexSanityCheckHelper::indexSanityCheck('number', $item);
                $newItem['name'] = IndexSanityCheckHelper::indexSanityCheck('name', $item);
                $newItem['description'] = IndexSanityCheckHelper::indexSanityCheck('description', $item);
                $newItem['type'] = IndexSanityCheckHelper::indexSanityCheck('type', $item);
                $newItem['is_buying'] = false;
                $newItem['is_selling'] = false;
                $newItem['buying_description'] = IndexSanityCheckHelper::indexSanityCheck('description', $item);
                $newItem['selling_description'] = IndexSanityCheckHelper::indexSanityCheck('description', $item);
                $newItem['selling_unit_price'] = IndexSanityCheckHelper::indexSanityCheck('salePrice',$item);
                $newItem['buying_unit_price'] = IndexSanityCheckHelper::indexSanityCheck('purchasePrice', $item);
                if (array_key_exists('saleAccount', $item)) {
                    if ($item['saleAccount']) {
                        $newItem['is_selling'] = true;
                        $newItem['selling_account_code'] = IndexSanityCheckHelper::indexSanityCheck('displayId', $item['saleAccount']);
                    }
                }

                if (array_key_exists('saleTaxType', $item)) {
                    if ($item['saleTaxType']) {
                        $newItem['selling_tax_type_code'] = IndexSanityCheckHelper::indexSanityCheck('code', $item['saleTaxType']);
                    }
                }

                if (array_key_exists('purchaseAccount', $item)) {
                    if ($item['purchaseAccount']) {
                        $newItem['is_buying'] = true;
                        $newItem['buying_account_code'] = IndexSanityCheckHelper::indexSanityCheck('displayId', $item['purchaseAccount']);
                    }
                }

                if (array_key_exists('purchaseTaxType', $item)) {
                    if ($item['purchaseTaxType']) {
                        $newItem['buying_tax_type_code'] = IndexSanityCheckHelper::indexSanityCheck('code', $item['purchaseTaxType']);
                    }
                }

                array_push($items, $newItem);
            }
        } else {
            $item = $this->data;
            $newItem = [];
            $newItem['accounting_id'] = IndexSanityCheckHelper::indexSanityCheck('uid', $item);
            $newItem['code'] = IndexSanityCheckHelper::indexSanityCheck('number', $item);
            $newItem['name'] = IndexSanityCheckHelper::indexSanityCheck('name', $item);
            $newItem['description'] = IndexSanityCheckHelper::indexSanityCheck('description', $item);
            $newItem['type'] = IndexSanityCheckHelper::indexSanityCheck('type', $item);
            $newItem['is_buying'] = false;
            $newItem['is_selling'] = false;
            $newItem['buying_description'] = IndexSanityCheckHelper::indexSanityCheck('description', $item);
            $newItem['selling_description'] = IndexSanityCheckHelper::indexSanityCheck('description', $item);
            $newItem['selling_unit_price'] = IndexSanityCheckHelper::indexSanityCheck('salePrice',$item);
            $newItem['buying_unit_price'] = IndexSanityCheckHelper::indexSanityCheck('purchasePrice', $item);
            if (array_key_exists('saleAccount', $item)) {
                if ($item['saleAccount']) {
                    $newItem['is_selling'] = true;
                    $newItem['selling_account_code'] = IndexSanityCheckHelper::indexSanityCheck('displayId', $item['saleAccount']);
                }
            }

            if (array_key_exists('saleTaxType', $item)) {
                if ($item['saleTaxType']) {
                    $newItem['selling_tax_type_code'] = IndexSanityCheckHelper::indexSanityCheck('code', $item['saleTaxType']);
                }
            }

            if (array_key_exists('purchaseAccount', $item)) {
                if ($item['purchaseAccount']) {
                    $newItem['is_buying'] = true;
                    $newItem['buying_account_code'] = IndexSanityCheckHelper::indexSanityCheck('displayId', $item['purchaseAccount']);
                }
            }

            if (array_key_exists('purchaseTaxType', $item)) {
                if ($item['purchaseTaxType']) {
                    $newItem['buying_tax_type_code'] = IndexSanityCheckHelper::indexSanityCheck('code', $item['purchaseTaxType']);
                }
            }

            array_push($items, $newItem);
        }


        return $items;
    }
}