<?php
/**
 * Created by IT-SKR.
 */

namespace Itskr\SkrLaravel;


use Illuminate\Support\Str;

class SkrResponse
{

    public function response($err_map_code,$data=null,$default_err_code = null,$default_http_code = null){
        //获取当前请求对应的配置
        $config = $this->getConfig();

        //获取对应的错误映射关键文件
        $err_map = $this->getErrMap($config,$err_map_code,$default_err_code,$default_http_code);

        $response_format = $this->getResponseFormat($config);

        return response([
            $response_format[0]=>$err_map[0],
            $response_format[1]=>$err_map[1],
            $response_format[2]=>$data],
            $err_map[2]);
    }

    /**
     * @return array|mixed 返回匹配到的文件
     * @throws \Exception
     */
    private function getConfig(){
        $configs = config('skr.response');
        if (empty($configs)){
            throw new \Exception('config/skr/response文件不存在，请执行php artisan vendor:publish');
        }

        $the_matched_config = [];

        foreach ($configs as $config){

            $ok_flag = $this->checkSkrHeaders($config);

            if ($ok_flag==1){
                return $config;
            }

            if (empty($the_matched_config)&&$ok_flag==0){
                $the_matched_config = $config;
            }
        }

        return $the_matched_config;
    }

    /**
     * @param $config
     * @return int 0 默认匹配，1 匹配成功，2 未匹配成功
     *
     */
    private function checkSkrHeaders($config){

        if (empty($config['source_headers'])){
            return 0;
        }

        if (!is_array($config['source_headers'])){
            return 2;
        }

        foreach ($config['source_headers'] as $key => $value){

            if (app('request')->header($key,null) != $value){
                return 2;
            }

        }

        return 1;
    }

    private function getErrMap($the_matched_config,$err_map_code,$err_code,$http_code){

        $default = config($the_matched_config['err_prefix'].".DEFAULT");

        if (!is_array($default)||count($default)!=3){
            return ['500999','未正确设置默认SKR错误信息',500];
        }

        if (substr($err_map_code,0,1)=='@'){

            $err_code = empty($err_code) ? $default[0]:$err_code;

            $http_code = empty($http_code) ? $default[2]:$http_code;

            return [$err_code,Str::after($err_map_code,'@'),$http_code];
        }

        return config($the_matched_config['err_prefix'].".$err_map_code")??$default;
    }

    private function getResponseFormat($the_matched_config){
        return $the_matched_config['response_format']??['skrCode','skrMsg','data'];
    }

}