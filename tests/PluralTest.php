<?php

namespace Opis\Intl\Test;

use Opis\Intl\Plural;

class PluralTest extends \PHPUnit\Framework\TestCase
{

    public function testForms()
    {

        $p = Plural::create('en_US');
        $this->assertEquals(2, $p->forms());

        $p = Plural::create('ro_RO');
        $this->assertEquals(3, $p->forms());
    }

    public function testRule()
    {
        $p = Plural::create('en_US');
        $this->assertEquals(0, $p->form(1));
        $this->assertEquals(1, $p->form(0));
        $this->assertEquals(1, $p->form(2));
        $this->assertEquals(1, $p->form(-2));

        $p = Plural::create('ro_RO');
        $this->assertEquals(0, $p->form(1));
        $this->assertEquals(1, $p->form(0));
        $this->assertEquals(1, $p->form(2));
        $this->assertEquals(2, $p->form(25));
        $this->assertEquals(2, $p->form(100));
    }
}