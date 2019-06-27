<?php
/**
 * Created by PhpStorm.
 * User: lw540
 * Date: 2019/6/26
 * Time: 22:30
 */

namespace Itskr\SkrLaravel;


use Illuminate\Config\Repository;
use Illuminate\Session\SessionManager;

class SkrValidate
{
    protected $session;
    protected  $config;
    protected $notifications = [];

    public function __construct(SessionManager $session,Repository $config)
    {
        $this->session = $session;
        $this->config = $config;
    }

    public function render(){
        $notifications = $this->session->get('skr:notifications');

        if(!$notifications) {
            return '';
        }

        foreach ($notifications as $notification) {
            $config = $this->config->get('skr.options');
            $javascript = '';
            $options = [];
            if($config) {
                $options = array_merge($config, $notification['options']);
            }

            if($options) {
                $javascript = 'toastr.options = ' . json_encode($options) . ';';
            }

            $message = str_replace("'", "\\'", $notification['message']);
            $title = $notification['title'] ? str_replace("'", "\\'", $notification['title']) : null;
            $javascript .= " toastr.{$notification['type']}('$message','$title');";
        }

        return view('Skr::toastr', compact('javascript'));
    }

}