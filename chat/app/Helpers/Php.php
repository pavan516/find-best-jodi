<?php 

namespace App\Helpers;

class Php 
{
    public function strtotime($time)
    {
        return strtotime($time);
    }
    public function str_to_lower(string $string)
    {
        return strtolower($string);
    }
    public function strip_tags(string $string)
    {
        return strip_tags($string);
    }
    public function substr( $string,  $initial =0,  $final =0)
    {
        return substr($string, $initial,$final);
    }
    public function strlen(string $string)
    {
        return strlen($string);
    }
    public function count($data)
    {
        return count($data);
    }
    public function getlastmod()
    {
        return getlastmod();
    }
    public function extractIds(array $array = null)
    {

        $ids = [];
        if (is_null($array)) {
            return null;
        }
        foreach ($array as $item) {

            array_push($ids, $item['id']);
        }
        return $ids;
    }
    public function simplifyArray(array $array = null)
    {
        if (is_null($array)) {
            return null;
        }
        $ids = [];        
        foreach ($array as $key=>$item) {

            array_push($ids, (int) $item);            
        }
        return $ids;
    }
    public function convertToInteger($string)
    {
        return (int) $string;
    }
    public function html_entity_decode($content)
    {
        return html_entity_decode($content);
    }
    public function str_word_count($string)
    {
        return  str_word_count($string);
    }
    function get_day_name($timestamp) {

        $date = date('d M, Y', $timestamp);
        $time = date('h.i A', $timestamp);
        if ($date == date('d M, Y')) {
          $date = 'Today';
        } 
        else if($date == date('d M, Y',time() - (24 * 60 * 60))) {
          $date = 'Yesterday';
        }
        return $date . " " .$time;
    }


}