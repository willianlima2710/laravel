<?php

namespace App\Helpers;
use DateTime;

class Functions
{
    //-- Converte data para formato Estados Unidos
    public static function DateToEua($value)
    {                            
        if (!empty($value)) {   
            $date = str_replace('/', '-', $value);
            return date("Y-m-d", strtotime($date));
        }else{
            return null; 
        }
    }

    //-- Converte data para formato Brasileiro
    public static function DateToBra($value)
    {                            
        if (!empty($value)) {   
            $date = str_replace('-', '/', $value);
            return date("d/m/Y", strtotime($date));
        }else{
            return null; 
        }
    }    

    //-- Converte data para formato Estado Unidos
    public static function MoedaEua($value)
    {        
        if (!empty($value)) {            
            return number_format( str_replace(',','.',$value) ,2,'.','');
        }else{
            return null;
        }    
    }

    //-- Calcula a diferença entre duas datas, retornando branco caso dia negativo
    public static function DateDiff($date1,$date2)
    {
        $dias = round(((strtotime($date1))-strtotime($date2))/60/60/24);
        if ($dias < 0) 
            $dias = '';
        return $dias;  
    }

    //-- Calcula a idade de uma pessoa
    public static function CalculaIdade($dtnascimento) 
    {
        $data = self::DateToEua($dtnascimento);
        $date = new DateTime($data);
        $interval = $date->diff( new DateTime( date('Y-m-d') ) );
        return $interval->format( '%Y' );
    }

}