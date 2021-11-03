<?php

declare(strict_types=1);

use App\ResourceNotFoundException;
use App\Split;
use PHPUnit\Framework\TestCase;

final class SplitTest extends TestCase
{
    private $split;

    function setUp(): void
    {
        $this->split = new Split();
    }

    function testFoundAllCharacterOccurance()
    {
        $haystack = "ubeu;dubuaedv;eugbuoqw;sdfqobf;dslbuv;hiqfb;dsviqf;bh28;buas33;vhais3;7vb;bue";
        $delimter = "u";

        $returnedValue = $this->split->getIndexedArray($haystack, $delimter);
        $expected = array(
            'ubeu',
            'dubuaedv',
            'eugbuoqw',
            'dslbuv',
            'buas33',
            'bue',
        );
        $this->assertEquals(true, $returnedValue == $expected);
    }

    function testResourceNotFound()
    {
        $this->expectException(ResourceNotFoundException::class);
        $this->split->getAssociativeArray("invalidpath.csv");
    }

    function testDelimiterIsWrong(){
        $returnedValue=$this->split->getAssociativeArray("kapcsolat.csv",'%');
        $line0 = array(
            'term_id1'      => '18863',
            'term_id2'      => '50665',
            'tipus'         => 'Együtt felhasználásra ajánlott',
            'megjegyzes'    => 'Élzárás amelyet, rendelésre elkészítünk!',
        );
        $this->assertEquals(false, $returnedValue[0] == $line0);
    }

    function testWorkingProperly(){
        $returnedValue=$this->split->getAssociativeArray("kapcsolat.csv");
        $line0 = array(
            'term_id1'      => '18863',
            'term_id2'      => '50665',
            'tipus'         => 'Együtt felhasználásra ajánlott',
            'megjegyzes'    => 'Élzárás amelyet, rendelésre elkészítünk!',
        );
        $this->assertEquals(true, $returnedValue[0] == $line0);
    }
}
