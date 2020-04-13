<?php declare(strict_types=1);

/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use PHPUnit\Framework\TestCase;

/**
 * @requires extension I_DO_NOT_EXIST
 */
class Issue1374Test extends TestCase
{
    public function testSomething(): void
    {
        $this->fail('This should not be reached');
    }

    protected function setUp(): void
    {
        print __FUNCTION__;
    }

    protected function tearDown(): void
    {
        print __FUNCTION__;
    }
}
