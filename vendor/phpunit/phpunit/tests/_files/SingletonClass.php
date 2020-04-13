<?php declare(strict_types=1);

/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class SingletonClass
{
    protected function __construct()
    {
    }

    public static function getInstance(): void
    {
    }

    public function doSomething(): void
    {
    }

    private function __sleep(): void
    {
    }

    private function __wakeup(): void
    {
    }

    private function __clone()
    {
    }
}
