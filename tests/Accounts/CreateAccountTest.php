<?php

namespace Tests;
use Faker;
class CreateAccountTest extends BaseTest
{
    public function testCreateAccount(){
        $this->setUp();
        try {

            $params = [
                'code' => 998,
                'name' => 'Test2',
                'type' => 'Current Assets',
                'type_id' => 2,
                'status' => 'ACTIVE',
                'description' => 'Test Description',
                'tax_type' => 'GST Free',
                'tax_type_id' => 8
            ];

            $response = $this->gateway->createAccount($params)->send();
            var_dump($response);
            if ($response->isSuccessful()) {
                $this->assertIsArray($response->getData());
                var_dump($response->getAccounts());
            }
            var_dump($response->getErrorMessage());
        } catch (\Exception $exception) {
            var_dump($exception->getTrace());
        }
    }
}