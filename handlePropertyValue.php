<?php
/**
 * Created by PhpStorm.
 * User: ycy
 * Date: 17-8-20
 * Time: 下午9:37
 */
namespace XYH\Magazine\Common\Utils;

trait handlePropertyValue
{
    /**
     * @param array $data
     * @param null  $obj
     *
     * @return $this|\XYH\Magazine\Common\Utils\handlePropertyValue
     */
    public function mapValues($data = [], $obj = null) {
        $obj = is_object($obj) ? $obj : $this;

        if (count($data) <= 0) return $obj;

        foreach($obj as $key => $value) {
            if (isset($data[$key])) {
                $obj->{$key} = $data[$key];
            }
        }
        return $obj;
    }

    public function setterValue($data = [],$obj = null){
        $obj = is_object($obj)?$obj:null;

        if(count($data) <= 0) return $obj;

        if(!is_null($obj)){
            foreach ($data as $key=>$value){
               $method_words = explode('_',$value);
               $method_name = join('',array_map(function($k){return ucwords($k);},$method_words));
               $method = "set".$method_name;
                if(method_exists($obj,$method)){
                    $obj->{$method}($value);
                }
            }
        }
        return $obj;
    }
}