<?php

namespace Tests\Invoices;


use Tests\BaseTest;

class CreateInvoiceTest extends BaseTest
{
    public function testCreateInvoice(){
        $this->setUp();
        try {

            $params = [
                'invoice_reference' => '20190806_0001',
                'type' => 'ACCREC',
                'date' => '2019-01-27',
                'due_date' => '2019-01-28',
                'contact' => '29140824',
                'total' => 6400,
                'status' => 'Open',
                'gst_inclusive' => true,
                'gst_registered' => true,
                'invoice_data' => [
                    [
                        'description' => 'Consulting services as agreed (20% off standard rate)',
                        'quantity' => 10,
                        'unit_amount' => 100.00,
                        'discount_rate' => 20,
                        'amount' => 800,
                        'code' => 200,
                        'unit' => 'QTY',
                        'tax_id' => '10',
                        'account_id' => '63240545',
                        'item_id' => '8101813'
                    ]
                ]
            ];

            $response = $this->gateway->createInvoice($params)->send();
            if ($response->isSuccessful()) {
                $this->assertIsArray($response->getData());
                var_dump($response->getInvoices());
            } else {
                var_dump($response->getErrorMessage());
            }
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
        }
    }
}