<?php
namespace PMVC\PlugIn\underscore;
${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\query';

class Query
{
    function __invoke()
    {
        return $this;
    }

    function parse_str($string)
    {
        parse_str($string,$arr);
        $new_arr = [];
        foreach($arr as $k=>$v){
            if ( false !== strpos($k,'_') &&
                    false === strpos($string,$k)
               ) {
                $new_k = str_replace('_','.',$k);
                if (false!==strpos($string,$new_k)) {
                    $new_arr[$new_k] = $v;
                    unset($arr[$k]);
                }
            }
        }
        $arr = array_replace($arr,$new_arr);
        return $arr;
    }

    function toArray($querys)
    {
        $all = [];
        foreach ($querys as $k=>$v) {
            $new = $this->parse_str($k.'='.$v);
            $all = array_replace_recursive(
                $all,
                $new
            );
        }
        return $all;
    }
}

