<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PHPUnit\Framework\MockObject\Matcher;

use PHPUnit\Framework\Constraint\Constraint;
use PHPUnit\Framework\Constraint\IsEqual;
use PHPUnit\Framework\Exception;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\MockObject\Invocation as BaseInvocation;
use PHPUnit\Util\InvalidArgumentHelper;
use SebastianBergmann\RecursionContext\InvalidArgumentException;
use function is_string;

/**
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
final class MethodName extends StatelessInvocation
{
    /**
     * @var Constraint
     */
    private $constraint;

    /**
     * @param Constraint|string
     *
     * @throws Constraint
     * @throws Exception
     */
    public function __construct($constraint)
    {
        if (!$constraint instanceof Constraint) {
            if (!is_string($constraint)) {
                throw InvalidArgumentHelper::factory(1, 'string');
            }

            $constraint = new IsEqual(
                $constraint,
                0,
                10,
                false,
                true
            );
        }

        $this->constraint = $constraint;
    }

    public function toString(): string
    {
        return 'method name ' . $this->constraint->toString();
    }

    /**
     * @return bool
     * @throws InvalidArgumentException
     *
     * @throws ExpectationFailedException
     */
    public function matches(BaseInvocation $invocation)
    {
        return $this->constraint->evaluate($invocation->getMethodName(), '', true);
    }
}
