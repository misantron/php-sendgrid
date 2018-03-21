<?php

namespace Misantron\SendGrid;


use Misantron\SendGrid\Api\Client;
use Misantron\SendGrid\Resource;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class SendGrid
 * @package Misantron\SendGrid
 *
 * @method Resource\Mail mail()
 * @method Resource\ApiKeys apiKeys()
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
        $resolver = new OptionsResolver();
        $resolver->setDefaults([
            'key' => getenv('SENDGRID_KEY'),
            'version' => 'v3'
        ]);

        $config = $resolver->resolve($config);

        $this->client = new Client($config);
    }

    /**
     * @param string $key
     * @return SendGrid
     */
    public static function create(string $key): SendGrid
    {
        return new static(['key' => $key]);
    }

    /**
     * @param string $name
     * @param array|null $arguments
     * @return Resource\Resource
     */
    public function __call(string $name, $arguments = null): Resource\Resource
    {
        $resource = __NAMESPACE__ . '\\Resource\\' . ucfirst($name);

        if (!class_exists($resource)) {
            throw new \InvalidArgumentException('Unknown API resource');
        }

        return new $resource($this->client);
    }
}