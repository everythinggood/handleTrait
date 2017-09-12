<?php
/**
 * Created by PhpStorm.
 * User: ycy
 * Date: 17-8-28
 * Time: 下午2:24
 */

namespace XYH\Magazine\Common\Utils;

//TODO must use in `Action`
class handleQuery
{
    public static function getViewClass(array $query, $key, $value)
    {
        if (isset($query[$key])) {
            return $query[$key] == $value ? 'active' : '';
        }
        return '';
    }

    //TODO wait for improve code
    public static function getViewUrlQuery(array $oldQuery, array $query, $moveSort = false)
    {
        if ($moveSort) {
            $result = [];
            if (isset($oldQuery['page'])) $result['page'] = $oldQuery['page'];
            if (isset($oldQuery['source'])) $result['source'] = $oldQuery['source'];
            if (isset($oldQuery['keyword'])) $result['keyword'] = $oldQuery['keyword'];
            return http_build_query($result);
        } else {
            return http_build_query(array_merge($oldQuery, $query));
        }
    }

    //TODO must no global variable
    public static function navIsActive($uri)
    {
        return (strpos($_SERVER['REQUEST_URI'], $uri)) !== false ? "active" : "";
    }

}