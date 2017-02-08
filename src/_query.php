<?php
namespace PMVC\PlugIn\underscore;
${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\query';

\PMVC\initPlugin(['url'=>null], true);

use PMVC\PlugIn\url\Query as Parse;

class Query
{
    function __invoke()
    {
        return $this;
    }

    function toArray($querys)
    {
        $all = [];
        foreach ($querys as $k=>$v) {
            $new = Parse::parse_str($k.'='.$v);
            $all = array_replace_recursive(
                $all,
                $new
            );
        }
        return $all;
    }
}

