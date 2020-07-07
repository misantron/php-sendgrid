<?php

declare(strict_types=1);

namespace Misantron\SendGrid\Tests\Unit;

use Misantron\SendGrid\SendGrid;
use PHPUnit\Framework\TestCase;

class SendGridTest extends TestCase
{
    public function testConstructorWithoutApiKey(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('API key is not defined');

        new SendGrid();
    }
}
