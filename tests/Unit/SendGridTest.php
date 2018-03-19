<?php

namespace Misantron\SendGrid\Tests\Unit;


use Misantron\SendGrid\Api\Client;
use Misantron\SendGrid\SendGrid;
use PHPUnit\Framework\TestCase;

class SendGridTest extends TestCase
{
    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage API key is not defined
     */
    public function testConstructorWithoutApiKey()
    {
        new SendGrid();
    }

    public function testConstructor()
    {
        $service = new SendGrid([
            'key' => 'SG.xxx.test'
        ]);

        $this->assertAttributeInstanceOf(Client::class, 'client', $service);
    }

    public function testCreate()
    {
        $service = SendGrid::create('SG.xxx.test');

        $this->assertAttributeInstanceOf(Client::class, 'client', $service);
    }
}