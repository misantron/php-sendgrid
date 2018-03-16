<?php

namespace Misantron\SendGrid;


use Misantron\SendGrid\Api\Client;
use Misantron\SendGrid\Resource\Resource;
use Misantron\SendGrid\Resource\Mail;

/**
 * Class SendGrid
 * @package Misantron\SendGrid
 *
 * @method Mail mail()
 */
class SendGrid
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->client = new Client($config);
    }

    /**
     * @param string $name
     * @param array|null $arguments
     * @return Resource
     */
    public function __call(string $name, $arguments = null): Resource
    {
        $resource = __NAMESPACE__ . '\\Resource\\' . ucfirst($name);

        return new $resource($this->client);
    }
}