<?php


namespace PHPAccounting\MyobEssentials\Helpers;


class ErrorResponseHelper
{
    /**
     * @param $response
     * @param string $model
     * @return string
     */
    public static function parseErrorResponse ($response, $model = '') {
        switch ($model) {
            case 'Account':
                if (strpos($response, 'Invalid authentication token') !== false) {
                    $response = 'The access token has expired';
                } elseif (strpos($response, 'page not found') !== false ) {
                    $response = 'NULL Returned from API or End of Pagination';
                }
                return $response;
                break;
            case 'Invoice':
                if (strpos($response, 'Invalid authentication token') !== false) {
                    $response = 'The access token has expired';
                } elseif (strpos($response, 'page not found') !== false ) {
                    $response = 'NULL Returned from API or End of Pagination';
                }
                return $response;
                break;
            case 'Contact':
                if (strpos($response, 'Invalid authentication token') !== false) {
                    $response = 'The access token has expired';
                } elseif (strpos($response, 'page not found') !== false ) {
                    $response = 'NULL Returned from API or End of Pagination';
                }
                return $response;
                break;
            case 'Inventory Item':
                if (strpos($response, 'Invalid authentication token') !== false) {
                    $response = 'The access token has expired';
                } elseif (strpos($response, 'page not found') !== false ) {
                    $response = 'NULL Returned from API or End of Pagination';
                }
                return $response;
                break;
            case 'Payment':
                if (strpos($response, 'Invalid authentication token') !== false) {
                    $response = 'The access token has expired';
                } elseif (strpos($response, 'page not found') !== false ) {
                    $response = 'NULL Returned from API or End of Pagination';
                }
                return $response;
            default:
                if (strpos($response, 'Invalid authentication token') !== false) {
                    $response = 'The access token has expired';
                } elseif (strpos($response, 'page not found') !== false ) {
                    $response = 'NULL Returned from API or End of Pagination';
                }
                return $response;
        }
    }
}