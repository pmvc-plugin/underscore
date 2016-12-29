<?php

namespace PMVC\PlugIn\underscore;

use PHPUnit_Framework_TestCase;

class ArrayTest extends PHPUnit_Framework_TestCase
{

    private $_plug = 'underscore';
    function testArrayToUnderscore()
    {
        $array = [
            'AAA'=>[
                'BBB'=>[
                    'CCC'=>'ddd',
                    'EEE'=>'fff'
                ],
                'GGG'=>'hhh'
            ]
        ];
        $plug = \PMVC\plug($this->_plug);
        $actual = $plug->array()->toUnderscore($array);
        $expected = [
            'AAA_BBB_CCC' => 'ddd',
            'AAA_BBB_EEE' => 'fff',
            'AAA_GGG' => 'hhh'
        ]; 
        $this->assertEquals($expected,$actual);
    }

    function testArrayToQuery()
    {
        $array = [
            'AAA'=>[
                'BBB'=>[
                    'CCC'=>'ddd',
                    'EEE'=>'fff'
                ],
                'GGG'=>'hhh'
            ]
        ];
        $plug = \PMVC\plug($this->_plug);
        $actual = $plug->array()->toQuery($array);
        $expected = [
            'AAA[BBB][CCC]' => 'ddd',
            'AAA[BBB][EEE]' => 'fff',
            'AAA[GGG]' => 'hhh'
        ]; 
        $this->assertEquals($expected,$actual);
    }

    function testSequenceToQuery()
    {
        $array = [
            ['a'],
            ['b'],
            ['c']
        ];
        $plug = \PMVC\plug($this->_plug);
        $actual = $plug->array()->toQuery($array);
        $expected = [
            '0[0]' => 'a',
            '1[0]' => 'b',
            '2[0]' => 'c'
        ]; 
        $this->assertEquals($expected,$actual);
    }
}
