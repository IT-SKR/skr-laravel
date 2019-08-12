# 关于 about skr-laravel 程序的唯一响应出口
帮助用户统一项目的响应格式，包括<br/>
response返回格式<br/>
throw Exception的格式<br/>
validate验证的返回格式<br/>

#例如
在config中配置错误码
```
[
    'ILLEGAL_MOBILE'=>["800007","手机格式不正确",200],
]
```
在config中配置响应格式
```
[
    'default'=>[
        'source_headers'=>null,//header中含有相关属性时，执行此响应格式
        'err_prefix'=>'skr.errors.default',//指向错误配置文件
        'response_format'=>['code','msg','data']//skr 默认返回格式
    ],
]
```

以下三种方式返回相同格式数据给端上<br/>
```
return Skr::response('ILLEGAL_MOBILE');//封装了系统的response方法
```
```
throw Skr::exception('ILLEGAL_MOBILE');//封装了系统的exception指向response
```
```
Skr::check($request->all(),['mobile'=>['required','ILLEGAL_MOBILE']]);//封装了validate
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
config目录下的app.php文件providers数组里面添加<br/>
Itskr\SkrLaravel\SkrServiceProvider::class

执行php artisan vendor:publish
