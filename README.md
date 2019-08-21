# 关于 about skr-laravel
程序的唯一响应出口，帮助用户统一项目的响应格式，包括<br/>
response返回格式<br/>
throw Exception的格式<br/>
validate验证的返回格式<br/>

## 例如 example
在config中配置错误码
```
[
    'ILLEGAL_MOBILE'=>["800007","手机格式不正确",200],
]
```
以下三种方式返回相同格式数据给端上<br/>
```
return Skr::response('ILLEGAL_MOBILE');
```
```
throw Skr::exception('ILLEGAL_MOBILE');
```
```
Skr::check($request->all(),['mobile'=>['required','ILLEGAL_MOBILE']]);
```

端上收到的格式如下
```
{
    "code":"800007",
    "msg":"手机格式不正确",
    "data":null
}
```

## 配置项目 config
step 1、下载composer包

```
composer require itskr/skr-laravel

```

step 2、config/app.php文件中的providers数组里面添加<br/>

```
Itskr\SkrLaravel\SkrServiceProvider::class
```

step 3、发布配置资源到config中，执行
```
php artisan vendor:publish --provider="Itskr\SkrLaravel\SkrServiceProvider"
```


step 4、屏蔽掉日志打印并拦截默认错误的输出，app/Exceptions/Handle.php文件中修改
```
    //屏蔽错误日志的打印
    protected $dontReport = [
        \Itskr\SkrLaravel\SkrException::class
    ];
    
    //将系统异常统一转化成系统繁忙
    public function render($request, Exception $exception)
    {
       return \Itskr\SkrLaravel\Skr::response("BUSY");//BUSY可替换成其他提示
    }
    
```


## 更多使用技巧 more
1、支持通过header自动识别响应格式，默认响应code、msg、data,参考config/skr/response.php
```
return [
    'default'=>[
        'source_headers'=>null,
        'err_prefix'=>'skr.errors.default',//指向错误码配置文件
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
```
2、用@符号开头，可以直接给端上返回错误信息，错误码取默认DEFAULT
```
throw Skr::exception('@自定义的错误');
```
3、用@符号开头，可以指定错误码
```
throw Skr::exception('@自定义的错误','1001');
```