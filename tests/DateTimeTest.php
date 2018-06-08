<?php

namespace Opis\Intl\Test;

use Opis\Intl\DateTimeFormatter;
use Opis\Intl\IDateTimeFormatter;

class DateTimeTest extends \PHPUnit\Framework\TestCase
{

    public function testFormat()
    {
        $d = DateTimeFormatter::create("en_US", "full", "full", null, null, "GMT");
        $this->doTests($d);
    }

    public function testOptions()
    {
        $d = DateTimeFormatter::fromArray([
            'locale' => 'en_US',
            'date' => 'full',
            'time' => 'full',
            'calendar' => 'gregorian',
            'timezone' => 'GMT',
        ]);

        $this->doTests($d);
    }

    protected function doTests(IDateTimeFormatter $d)
    {
        $this->assertContains($d->format(0), [
            'January 1, 1970, 12:00 AM', // no intl
            'Thursday, January 1, 1970 at 12:00:00 AM GMT', // different icu
            'Thursday, January 1, 1970 at 12:00:00 AM Greenwich Mean Time',
        ]);

        $this->assertContains($d->formatDate(0), [
            'January 1, 1970', // no intl
            'Thursday, January 1, 1970',
        ]);

        $this->assertContains($d->formatTime(0), [
            '12:00 AM', // no intl
            '12:00:00 AM GMT', // different icu
            '12:00:00 AM Greenwich Mean Time',
        ]);
    }
}