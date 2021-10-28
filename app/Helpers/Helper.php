<?php

namespace App\Helpers;

class Helper
{
    public static function getItem($data)
    {
        $array = array(
            
            // whats number
            'whats1' => "",
            'link-whats1' => "https://api.whatsapp.com/send?phone=5511",
            'whats2' => '',
            'link-whats2' => "https://api.whatsapp.com/send?phone=5511",
            'email-client' => 'pena.leko14@gmail.com',
        );

        if (isset($array[$data])){
            return $array[$data];
        }else {
           return "nada encontrado";
        }
    }
}