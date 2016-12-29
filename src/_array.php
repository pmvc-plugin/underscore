<?php
namespace PMVC\PlugIn\underscore;
${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\ArrayConvert';

class ArrayConvert 
{
    function __invoke()
    {
        return $this;
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

    function toQuery($array, $key='')
    {
        $new = [];
        foreach($array as $k=>$v) {
            if (strlen($key)) {
                $tpl = $key.'['.$k.']';
            } else {
                $tpl = $k;
            }
            if (is_array($v)) {
               $flatten = $this->toQuery($v, $tpl);  
               $new = array_merge_recursive($new,$flatten);
            } else {
               $new [$tpl] = $v;
            }
        }
        return $new;
    }
}
