<?php
PMVC\Load::plug();
PMVC\addPlugInFolders(['../']);
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

    function testParsePointQuery()
    {
        $p = PMVC\plug($this->_plug);
        $o = $p->query()->parse_str('xxx.yyy=zzz&aaa_bbb=ccc');
        $this->assertEquals('zzz',$o['xxx.yyy']);
        $this->assertEquals('ccc',$o['aaa_bbb']);
    }

    function testSetSpaceQuery()
    {
        $p = PMVC\plug($this->_plug);
        $o = $p->query()->parse_str('xxx%20yyy=zzz&aaa bbb=ccc');
        $this->assertEquals('zzz',$o['xxx_yyy']);
        $this->assertEquals('ccc',$o['aaa_bbb']);
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
