<?php
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
        $actual = $plug->underscore()->toArray($underscore);
        $expected = [
            'AAA'=>[
                'BBB'=>[
                    'CCC'=>'ddd'
                ]
            ]
        ];
        $this->assertEquals($expected,$actual);
    }

    function testUnderscoreWithSubArrayToArray()
    {
        $underscore = [
            'aaa_bbb'=>[
                'ddd_eee'=>'fff',
                'ggg_hhh'=>'iii'
            ]
        ];
        $expected = [
            'aaa'=>[
                'bbb'=>[
                    'ddd'=>[
                        'eee'=>'fff'
                    ],
                    'ggg'=>[
                        'hhh'=>'iii'
                    ]
                ]
            ]
        ];
        $plug = \PMVC\plug($this->_plug);
        $actual = $plug->underscore()->toArray($underscore);
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
