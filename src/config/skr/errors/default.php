<?php
/**
 * first errCode  参数一错误码
 *
 * second errMsg  参数二错误信息
 *
 * third httpCode 参数三 http状态码
 */
return [
    'SUCCESS' => ['200000', "SUCCESS", 200],
    'BUSY' => ['500000', "系统繁忙", 500],
    'DEFAULT' => ['500999', "未知错误", 500],
];