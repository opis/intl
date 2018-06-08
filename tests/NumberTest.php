<?php

namespace Opis\Intl\Test;

use Opis\Intl\{
    IntlChecker, NumberFormatter
};

class NumberTest extends \PHPUnit\Framework\TestCase
{

    const NUMBER = 987612345.06789;

    public function testFormat()
    {
        $n = NumberFormatter::create('en_US');

        $this->assertEquals('987,612,345.068', $n->formatDecimal(self::NUMBER));
        $this->assertEquals('$987,612,345.07', $n->formatCurrency(self::NUMBER));
        $this->assertEquals('£987,612,345.07', $n->formatCurrency(self::NUMBER, 'GBP'));
        $this->assertEquals('€987,612,345.07', $n->formatCurrency(self::NUMBER, 'EUR'));
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

        $intl = IntlChecker::extensionExists();

        $this->assertEquals($intl ? '987,612,345.067' : '987,612,345.068', $n->formatDecimal(self::NUMBER));
        $this->assertEquals($intl ? '€987,612,345.07' : '$987,612,345.07', $n->formatCurrency(self::NUMBER));
        $this->assertEquals('£987,612,345.07', $n->formatCurrency(self::NUMBER, 'GBP'));
        $this->assertEquals('$987,612,345.07', $n->formatCurrency(self::NUMBER, 'USD'));
        $this->assertEquals($intl ? '25/100' : '25%', $n->formatPercent(0.25));
    }


}