<?php

namespace BokkaWP\Utilities;

class Alerts {
    public function __construct()
    {

    }

    public function send($errors = array(), $severity = "warning", $app = false){

            if(count($errors) < 1){
                error_log('Bokka Utilities: Alerts Empty array of errors');
                return;
            }

            $app = $app ? $app : $_SERVER['HTTP_HOST'];
             // create curl resource
            $url = "http://138.68.19.98:8080/incoming-hooks/errors";
            $data = array(
                'app'   => $app,
                'level' => $severity,
                'url'   =>  $_SERVER['HTTP_HOST'],
                'errors' =>  $errors,
            );
            $post = json_encode($data);

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($post))
            );

            $result = curl_exec($ch);
            return $result;
    }

    public static function get_instance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }
}


$BokkaWPUtilities = Alerts::get_instance();