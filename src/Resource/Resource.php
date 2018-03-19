<?php

namespace Misantron\SendGrid\Resource;


use Misantron\SendGrid\Api\Client;

/**
 * Class Resource
 * @package Misantron\SendGrid\Resource
 */
abstract class Resource
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return string
     */
    abstract protected function basePath(): string;

    /**
     * @param array $data
     * @return string
     */
    protected function query(array $data): string
    {
        return http_build_query($data);
    }
}