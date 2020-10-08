<?php

namespace App;


class URLHelper
{
    public static function withParam ($data, $param, $value) {
        return http_build_query(array_merge($data, [$param => $value]));
    }

    public static function withParams($data, $params) {
        return http_build_query(array_merge($data, $params));
    }
}
