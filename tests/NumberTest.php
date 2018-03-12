<?php

namespace Opis\Intl\Test;

use Opis\Intl\NumberFormatter;

class NumberTest extends \PHPUnit\Framework\TestCase
{

    const NUMBER = 987612345.06789;

    public function testFormat()
    {
        $n = NumberFormatter::create('en_US');

        $this->assertEquals('987,612,345.068', $n->formatDecimal(self::NUMBER));
        $this->assertEquals('$987,612,345.07', $n->formatCurrency(self::NUMBER));
        $this->assertEquals('£987,612,345.07', $n->formatCurrency(self::NUMBER, 'GBP'));
        $this->assertEquals('25%', $n->formatPercent(0.25));
    }

    public function testOptions()
    {
        $n = NumberFormatter::fromArray([
            'locale' => 'en_US',
            'decimal' => [
                'rounding_mode' => 'down',
            ],
            'currency' => [
                'currency_code' => 'EUR',
            ],
            'percent' => [
                'percent_symbol' => '/100',
            ]
        ]);

        $this->assertEquals('987,612,345.067', $n->formatDecimal(self::NUMBER));
        $this->assertEquals('€987,612,345.07', $n->formatCurrency(self::NUMBER));
        $this->assertEquals('£987,612,345.07', $n->formatCurrency(self::NUMBER, 'GBP'));
        $this->assertEquals('25/100', $n->formatPercent(0.25));
    }


}