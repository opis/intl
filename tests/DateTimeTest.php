<?php

namespace Opis\Intl\Test;

use Opis\Intl\DateTimeFormatter;

class DateTimeTest extends \PHPUnit\Framework\TestCase
{

    public function testFormat()
    {
        $d = DateTimeFormatter::create("en_US", "full", "full", null, null, "GMT");

        $this->assertContains($d->format(0), [
            'Thursday, January 1, 1970 at 12:00:00 AM GMT',
            'Thursday, January 1, 1970 at 12:00:00 AM Greenwich Mean Time',
        ]);

        $this->assertEquals('Thursday, January 1, 1970', $d->formatDate(0));

        $this->assertContains($d->formatTime(0), [
            '12:00:00 AM GMT',
            '12:00:00 AM Greenwich Mean Time',
        ]);
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

        $this->assertContains($d->format(0), [
            'Thursday, January 1, 1970 at 12:00:00 AM GMT',
            'Thursday, January 1, 1970 at 12:00:00 AM Greenwich Mean Time',
        ]);

        $this->assertEquals('Thursday, January 1, 1970', $d->formatDate(0));

        $this->assertContains($d->formatTime(0), [
            '12:00:00 AM GMT',
            '12:00:00 AM Greenwich Mean Time',
        ]);
    }

}