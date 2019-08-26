<?php
/**
 * Created by IntelliJ IDEA.
 * User: Max
 * Date: 5/29/2019
 * Time: 2:38 PM
 */

namespace Tests\Contacts;
use Faker;
use Tests\BaseTest;

class DeleteContactTest extends BaseTest
{
    /**
     *
     */
    public function testDeleteContact()
    {
        $this->setUp();
        try {

            $params = [
                'accounting_id' => '29140062',
            ];

            $response = $this->gateway->deleteContact($params)->send();
            var_dump($response);
            if ($response->isSuccessful()) {
                $contacts = $response->getContacts();
                var_dump($contacts);
                $this->assertIsArray($contacts);
            }
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
        }
    }
}