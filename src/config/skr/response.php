<?php
/**
 * source_headers
 * 通过header中的哪些字段判断数据来源
 * 如果 source_headers 不设置，则默认此返回格式，优先匹配配置了source_headers的规则
 *
 * err_prefix
 * 指定错误编码文件
 *
 * response_format
 * 指定返回格式
 *
 */
return [
    'default'=>[
        'source_headers'=>null,
        'err_prefix'=>'skr.errors.default',
        'response_format'=>['code','msg','data']//skr 默认返回格式
    ],
    'others'=>[
        'source_headers'=>[
            'skr-source-others'=>'skr_others' //当herder中存在键skr-source-others的值为skr_others 时则走此条规则
        ],
        'err_prefix'=>'skr.errors.default',
        'response_format'=>['errCode','errMsg','data']//skr 其他返回格式
    ]
];