<?php
namespace PMVC\PlugIn\underscore;
${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\FromUnderscore';

class FromUnderscore
{
    function __invoke()
    {
        return $this;
    }

    function toArray($underscore, $escape = null)
    {
        $new = [];
        foreach($underscore as $k=>$v) {
            if (is_array($v)) {
                $new1 = $this->multiValueToArray($k,$v);
            } else {
                $new1 = $this->keyValueToArray($k,$v,$escape);
            }
            $new = array_replace_recursive($new,$new1);
        }
        return $new;
    }

    function multiValueToArray($k,array $v)
    {
        $v_arr = $this
            ->caller
            ->array()
            ->toUnderscore($v,$k.'_');
        $new = $this->toArray($v_arr);
        return $new;
    }

    function keyValueToArray($k,$v,$escape)
    {
        if (!is_null($escape) && 0===strpos($k,$escape)) {
            $k = substr($k, strlen($escape));
            return [$k=>$v];
        }
        $keys = explode('_',$k);
        $str = ''; 
        foreach($keys as $k1) {
           if (!strlen($k1)) {
               $k1 = '_';
           }
           $k1 = urlencode($k1);
           if (empty($str)) {
               $str = $k1;
           }else{
               $str .= '['.$k1.']'; 
           }   
        }   
        $str.='='.urlencode($v);
        parse_str($str,$new);
        return $new;
    }
}
