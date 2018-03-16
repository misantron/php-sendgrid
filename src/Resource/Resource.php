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
     * @var string
     */
    private $version;

    /**
     * @param Client $client
     * @param string $version
     */
    public function __construct(Client $client, string $version)
    {
        $this->client = $client;
        $this->version = $version;
    }

    /**
     * @param string $path
     * @return string
     */
    protected function uri(string $path): string
    {
        return sprintf('%s/%s', $this->version, $path);
    }

    /**
     * @param array $data
     * @return string
     */
    protected function query(array $data): string
    {
        return http_build_query($data);
    }
}