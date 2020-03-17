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
            default:
                if (strpos($response, 'Invalid authentication token') !== false) {
                    $response = 'The access token has expired';
                } elseif (strpos($response, 'already exists') !== false || strpos($response, 'has been taken') !== false) {
                    $response = 'Duplicate model found';
                } elseif (strpos($response, 'may not be null') !== false) {
                    $response = 'Model cannot be edited';
                } elseif (strpos($response, 'page not found') !== false ) {
                    $response = 'NULL Returned from API or End of Pagination';
                }
                return $response;
        }
    }
}