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
 * Class for testing Canada Day in Canada.
 */
class CanadaDayTest extends CanadaBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'canadaDay';

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 1879;

    /**
     * Tests Canada Day on or after 1983. Since 1983, Canada Day is July 1, unless July 1 is a Sunday, in which case
     * the holiday is observed on July 2.
     *
     * @throws \Exception
     */
    public function testCanadaDayOnAfter1983(): void
    {
        $year = 2019; // July 1 is not Sunday
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-07-01", new \DateTimeZone(self::TIMEZONE))
        );
        $year = 2018; // July 1 is Sunday
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-07-02", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Canada Day between 1879 and 1982. Dominion Day was always observed on July 1, even when July 1 was a
     * Sunday (the July 2 substitution was only introduced in 1983).
     *
     * @throws \Exception
     */
    public function testCanadaDayOnOrBefore1982(): void
    {
        $year = 1979; // July 1 is a Sunday, but no substitution applied before 1983
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-07-01", new \DateTimeZone(self::TIMEZONE))
        );
        $year = 1981; // July 1 is not a Sunday
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-07-01", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Canada Day before 1879. Canada Day was established as Dominion Day in 1879 on July 1st.
     *
     * @throws \Exception
     */
    public function testCanadaDayBefore1879(): void
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
            [self::LOCALE => 'Canada Day']
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
}
