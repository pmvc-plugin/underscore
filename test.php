<?php
PMVC\Load::plug();
PMVC\addPlugInFolder('../');
class UnderscoreTest extends PHPUnit_Framework_TestCase
{
    private $_plug = 'underscore';
    function testPlugin()
    {
        ob_start();
        print_r(PMVC\plug($this->_plug));
        $output = ob_get_contents();
        ob_end_clean();
        $this->assertContains($this->_plug,$output);
    }

    function testUnderscoreToArray()
    {
        # load dot file
        $underscore = [
            'AAA_BBB_CCC'=>'ddd'
        ]; 
        $plug = \PMVC\plug($this->_plug);
        $actual = $plug->array()->toArray($underscore);
        $expected = [
            'AAA'=>[
                'BBB'=>[
                    'CCC'=>'ddd'
                ]
            ]
        ];
        $this->assertEquals($expected,$actual);
    }

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

    function testCamelCaseToArray()
    {
        $s = 'AaaBbbCcc';
        $plug = \PMVC\plug($this->_plug);
        $actual = $plug->camelCase()->toArray($s);
        $expected = [
            'Aaa',
            'Bbb',
            'Ccc'
        ];
        $this->assertEquals($expected,$actual);
    }

    function testCamelCaseToUnserscore()
    {
        $s = 'AaaBbbCcc';
        $plug = \PMVC\plug($this->_plug);
        $actual = $plug->camelCase()->toUnderscore($s);
        $expected = 'aaa_bbb_ccc';
        $this->assertEquals($expected,$actual);
    }
}
