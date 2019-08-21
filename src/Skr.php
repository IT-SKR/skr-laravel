<?php


namespace Itskr\SkrLaravel;


class Skr
{

    public static function check(array $params, array $rules)
    {
        SkrValidate::check($params, $rules);
    }

    public static function response($err_map_code, $data = null, $default_err_code = null, $default_http_code = null)
    {
        $skr_response = new SkrResponse();
        return $skr_response->response($err_map_code, $data, $default_err_code, $default_http_code);
    }

    public static function exception(string $message, string $code = '')
    {
        return new SkrException($message, $code);
    }
}