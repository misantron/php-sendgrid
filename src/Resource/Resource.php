<?php

namespace Misantron\SendGrid\Resource;


use Misantron\SendGrid\Api\Client;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
     * @var OptionsResolver
     */
    private $resolver;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->resolver = new OptionsResolver();
    }

    /**
     * @return string
     */
    abstract protected function basePath(): string;

    /**
     * @return OptionsResolver
     */
    protected function getResolver(): OptionsResolver
    {
        return $this->resolver->clear();
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