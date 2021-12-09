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

    public static function getDate($date)
    {
        $arrayDate = explode("/", $date);
        $arrayResult = [];
        foreach ($arrayDate as $val) {
            array_unshift($arrayResult, $val);
        }
        return implode("-",$arrayResult);
    }

    public static function getUrl($string)
    {
        $table = array(
            '/'=>'', '('=>'', ')'=>'',
        );
        $string = strtr($string, $table);
        $string = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string);
        $string= preg_replace('/[,.;:`´^~\'"]/', null, iconv('UTF-8','ASCII//TRANSLIT',$string));
        $string= strtolower($string);
        $string= str_replace("?", " ", $string);
        $string= str_replace(" ", "-", $string);
        $string= str_replace("---", "-", $string);
        return $string;
    }

    public static function formatCurrency($get_valor) {

        $source = array('.', ',');
        $replace = array('', '.');
        $valor = str_replace($source, $replace, $get_valor);
        return $valor;
    }
}
