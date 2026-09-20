<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\Sample;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(Sample::class)]
final class SampleTest extends TestCase
{
    private Sample $sample;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sample = new Sample();
    }

    #[Test]
    public function resetSessionRemovesKnownKeys(): void
    {
        $session = [
            'numberA' => 100,
            'numberB' => 50,
            '123456789012_someKey' => 'someValue',
            'notMatchedKey' => 'value',
        ];

        $this->sample->resetSession($session);

        self::assertArrayNotHasKey('numberA', $session);
        self::assertArrayNotHasKey('numberB', $session);
        self::assertArrayNotHasKey('123456789012_someKey', $session);
        self::assertArrayHasKey('notMatchedKey', $session);
    }

    #[Test]
    public function resetSessionLeavesUnrelatedKeysUntouched(): void
    {
        $session = [
            'user' => 'alice',
            '12345678901a_notNumeric' => 'kept',
        ];

        $this->sample->resetSession($session);

        self::assertSame(['user' => 'alice', '12345678901a_notNumeric' => 'kept'], $session);
    }
}
