<?php
namespace PMVC\PlugIn\underscore;
${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\FromUnderscore';

class FromUnderscore
{
    function __invoke()
    {
        return $this;
    }

    function toArray($underscore)
    {
        $new = [];
        foreach($underscore as $k=>$v) {
            if (is_array($v)) {
                $new1 = $this->multiValueToArray($k,$v);
            } else {
                $new1 = $this->keyValueToArray($k,$v);
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

    function keyValueToArray($k,$v)
    {
        $keys = explode('_',$k);
        $str = ''; 
        foreach($keys as $k1) {
           if (empty($str)) {
               $str = $k1;
           }else{
               $str .= '['.$k1.']'; 
           }   
        }   
        $str.='='.$v;
        parse_str($str,$new);
        return $new;
    }
}
