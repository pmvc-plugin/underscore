<?php

namespace PMVC\PlugIn\underscore;

use PHPUnit_Framework_TestCase;

class QueryTest extends PHPUnit_Framework_TestCase
{

    private $_plug = 'underscore';

    function testQueryToArray()
    {
        $querys = [
            'AAA[BBB][CCC]' => 'ddd',
            'AAA[BBB][EEE]' => 'fff',
            'AAA[GGG]' => 'hhh'
        ]; 
        $plug = \PMVC\plug($this->_plug);
        $actual = $plug->query()->toArray($querys);
        $expected = [
            'AAA'=>[
                'BBB'=>[
                    'CCC'=>'ddd',
                    'EEE'=>'fff'
                ],
                'GGG'=>'hhh'
            ]
        ];
        $this->assertEquals($expected,$actual);
    }
}
