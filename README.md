# 关于 about skr-laravel
帮助用户统一项目的响应格式，包括<br/>
response返回格式<br/>
throw Exception的格式<br/>
validate验证的返回格式<br/>
<br/><br/>
以下三种方式返回相同格式数据给端上，都将返回config中配置好的ILLEGAL_MOBILE错误信息<br/>
return Skr::response('ILLEGAL_MOBILE');<br/>
throw Skr::exception('ILLEGAL_MOBILE');<br/>
Skr::check($request->all(),['mobile'=>['required','ILLEGAL_MOBILE']]);<br/>

## 配置项目 config
config目录下的app.php文件providers数组里面添加<br/>
Itskr\SkrLaravel\SkrServiceProvider::class

执行php artisan vendor:publish
