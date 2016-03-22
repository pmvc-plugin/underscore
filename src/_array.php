<?php
namespace PMVC\PlugIn\underscore;
${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\ArrayConvert';

class ArrayConvert 
{
    function __invoke()
    {
        return $this;
    }

    function toArray($underscore)
    {
        $new = [];
        foreach($underscore as $k=>$v) {
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
            parse_str($str,$new1);
            $new = array_merge_recursive($new,$new1);
        }
        return $new;
    }

    function toUnderscore($array, $key='')
    {
        $new = [];
        foreach($array as $k=>$v) {
            if (is_array($v)) {
               $flatten = $this->toUnderscore($v, $key.$k.'_');  
               $new = array_merge_recursive($new,$flatten);
            } else {
               $new [$key.$k] = $v;
            }
        }
        return $new;
    }
}
