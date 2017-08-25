<?php
/**
 * Created by PhpStorm.
 * User: ycy
 * Date: 17-8-23
 * Time: 下午2:20
 */
namespace XYH\Magazine\Common\Utils;

use Slim\Http\Uri;

/**
 * Trait handlePage
 * @package XYH\Magazine\Common\Utils
 */
trait handlePage{

    public static $page_item_num = 10;
    public static $page_show_num = 5;

    public function getPageCount($itemCount){
        return ceil($itemCount/self::$page_item_num);
    }

    public function getPageItemNum(){
        return self::$page_item_num;
    }

    public function setPageItemNum($page_item_num){
        self::$page_item_num = $page_item_num;
    }

    public function getPageShowNum(){
        return self::$page_show_num;
    }

    public function setPageShowNum($page_show_num){
        self::$page_show_num = $page_show_num;
    }

    public function getSkip($page){
        return $page*self::$page_item_num;
    }

    /**
     * @param $uri Uri
     * @param $page int
     * @return string
     */
    private function getPageUrl($uri,$page){
        parse_str($uri->getQuery(),$query);
        $query['page'] = $page;
        return $uri->getPath().'?'.http_build_query($query);
    }

    /**
     * retrun PageUrls to view
     * @param $uri
     * @param $pageCount
     * @param $page
     * @return array
     */
    public function getPageUrls($uri, $pageCount, $page){
        $result = [];

        if($page > 1) $result['pre'] = $this->getPageUrl($uri,$page-1);

        $pages = $this->getPages($pageCount,$page);

        foreach ($pages as $key=>$currentPage){
            $result[$currentPage]['url'] = $this->getPageUrl($uri,$currentPage);
            if($currentPage == $page) $result[$currentPage]['class'] = 'active';
            if($currentPage != $page) $result[$currentPage]['class'] = "";
        }

        if($page < $pageCount) $result['next'] = $this->getPageUrl($uri,$page+1);

        return $result;
    }

    /**
     * return Pages on page_show_num
     * @param $pageCount
     * @param $page
     * @return array
     */
    public function getPages($pageCount,$page){
        $pages = [];
        $page_start = 1;

        $page_show_half_num = floor(self::$page_show_num/2);
        //the sort can not move as follow
        if($page-$page_show_half_num > 0) $page_start = $page-$page_show_half_num;
        if($pageCount-$page_show_half_num < $page) $page_start = $pageCount-(self::$page_show_num-1);
        if($page-$page_show_half_num <= 0) $page_start = 1;

        for($i=$page_start;$i<=$pageCount&$i<$page_start+5;$i++){
            $pages[] = $i;
        }
        return  $pages;
    }


}