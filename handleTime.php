<?php
/**
 * Created by PhpStorm.
 * User: ycy
 * Date: 17-8-31
 * Time: 下午2:56
 */

namespace XYH\Magazine\Common\Utils;


class handleTime
{

    public static function getCurrentMonthDateByAsc(){
        $month_start = strtotime(date('Y-m-01',time()));
        $month_end = time();
        $month_date = [];
        while($month_start <= $month_end){
            $month_start = date('Y-m-d',$month_start);
            $month_date[] = $month_start;
            $month_start = strtotime($month_start.' +1 day');
        }
        return $month_date;
    }
    public static function getCurrentMonthDateByDesc(){
        $month_start = strtotime(date('Y-m-01',time()));
        $month_end = time();
        $month_date = [];
        while($month_end >= $month_start){
            $month_end = date('Y-m-d',$month_end);
            $month_date[] = $month_end;
            $month_end = strtotime($month_end.' -1 day');
        }
        return $month_date;
    }


}