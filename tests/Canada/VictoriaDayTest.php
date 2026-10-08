<?php

declare(strict_types = 1);

/**
 * This file is part of the 'Yasumi' package.
 *
 * The easy PHP Library for calculating holidays.
 *
 * Copyright (c) 2015 - 2026 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\tests\Canada;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Victoria Day in Canada.
 */
class VictoriaDayTest extends CanadaBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'victoriaDay';

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 1845;

    /**
     * Tests Victoria Day on or after 1845. Victoria Day is celebrated on the last Monday on or before May 24.
     *
     * @throws \Exception
     */
    public function testVictoriaDayOnAfter1845(): void
    {
        $year = 2019;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            $this->getVictoriaDayDate($year)
        );

        $year = 2024;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            $this->getVictoriaDayDate($year)
        );
    }

    /**
     * Tests Victoria Day before 1845.
     *
     * @throws \Exception
     */
    public function testVictoriaDayBefore1845(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1)
        );
    }

    /**
     * Tests translated name of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(self::ESTABLISHMENT_YEAR),
            [self::LOCALE => 'Victoria Day']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(self::ESTABLISHMENT_YEAR),
            Holiday::TYPE_OFFICIAL
        );
    }

    /**
     * Returns the expected Victoria Day date (the Monday on or before May 24) for the given year.
     *
     * @throws \Exception
     */
    private function getVictoriaDayDate(int $year): \DateTimeInterface
    {
        $date = new \DateTime("last monday front of {$year}-05-25", new \DateTimeZone(self::TIMEZONE));

        return new \DateTime($date->format('Y-m-d'), new \DateTimeZone(self::TIMEZONE));
    }
}
