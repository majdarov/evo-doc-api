<?php

namespace App\Tests;

use App\Entity\Contragent;
use App\Entity\ContragentType;
use PHPUnit\Framework\TestCase;

class ContragentTest extends TestCase
{
    public function testSomething(): void
    {
        $cnt_type = (new ContragentType())->setCntType('test type');
        $contragent = (new Contragent())
            ->setCntName('test')
            ->setCntInfo('test info')
            ->setCntType($cnt_type);
        $this->assertSame('test', $contragent->getCntName());
        $this->assertSame('test info', $contragent->getCntInfo());
        $this->assertIsObject($contragent->getCntType());
        $this->assertEquals('test type', $contragent->getCntTypeString());
    }
}
