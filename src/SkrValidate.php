<?php


namespace Itskr\SkrLaravel;
use Illuminate\Validation\Validator;

class SkrValidate
{
    /**
     *  对laravel错误信息处理的拓展
     *  1、可以抛出自定义信息
     *  2、可以抛出config中配置的错误信息
     *  3、可以抛出laravel自己的错误信息
     *
     * @param array $params
     * @param array $rules
     * @throws SkrException
     */
    public static function check(array $params, array $rules){

        //如果没有传递规则
        if (empty($rules)||!is_array($rules)){
            throw new SkrException('@hfas validate rules can not be empty');
        }

        //重构laravel 规则
        $laravel_rules = self::rebuildRules($rules);

        //开启验证
        $validator = Validator::make($params,$laravel_rules);

        //校验消息
        if ($validator->fails()){
            $messages = $validator->errors()->getMessages();
            foreach ($messages as $key=>$value){
                if (isset($rules[$key][1])){
                    //如果设置了错误信息
                    throw new SkrException($rules[$key][1]);
                }else{
                    //如果没有设置错误信息，则抛出laravel自带的错误提示
                    $msg = current($value);
                    throw new SkrException("@$msg");
                }
            }
        }
    }


    /**
     * @param array $params
     * @param array $requires
     * 必填项
     * @param string $rule
     * @throws SkrException
     */
    public static function commCheck(array $params, array $requires = [],$rule='default'){

        //通用校验
        self::check($params,config("hjs.validate.$rule"));

        //校验必填项
        if (!empty($requires)){
            self::check($params,self::requiredRules($requires));
        }

    }

    //
    private static function requiredRules($requires){
        $rules = [];
        foreach ($requires as $require){
            $rules+= [$require=>['required']];
        }
        return $rules;
    }

    /**
     * 返回符合laravel规范的错误信息
     * @param array $rules
     * @return array
     */

    private static function rebuildRules(array $rules){
        $laravel_rules = [];
        foreach ($rules as $key=>$value){
            $laravel_rules += [$key=>$value[0]];
        }
        return $laravel_rules;
    }

}