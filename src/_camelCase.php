<?php
namespace PMVC\PlugIn\underscore;
${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\CamelCase';

class CamelCase
{
    function __invoke()
    {
        return $this;
    }

    function toArray($camelcase)
    {
        $arr = preg_split(
            '/([A-Z][^A-Z]*)/',
            $camelcase,
            -1,
            PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY
        );
        return $arr;
    }

    function toUnderscore($camelcase)
    {
        $arr = $this->toArray($camelcase);
        $k = '';
        for ($i = 1, $j = count($arr); $i < $j; $i++) {
            $k .= '_'.strtolower($arr[$i]);
        }
        $k = strtolower($arr[0]).$k;

        return $k;
    }
}
