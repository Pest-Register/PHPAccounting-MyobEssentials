<?php


namespace PHPAccounting\MyobEssentials\Helpers;


class BuildEndpointHelper
{
    public static function loadByGUID($endpoint, $guid, $filterPrefix='') {
        $prefix = '?$';
        $endpoint = $endpoint . $prefix."filter=".$filterPrefix."UID eq guid'".$guid."'";
        return $endpoint;
    }

    public static function paginate($endpoint, $page) {
        $prefix = '?$';
        $endpoint = $endpoint . $prefix."top=".$page;
        return $endpoint;
    }
}