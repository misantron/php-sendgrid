<?php

declare(strict_types=1);

namespace Misantron\SendGrid\Api;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Psr\Http\Message\RequestInterface;

/**
 * Class Client
 * @package Misantron\SendGrid\Api
 */
class Client
{
    private const ENDPOINT = 'https://api.sendgrid.com';

    /**
     * @var ClientInterface
     */
    protected $transport;

    /**
     * @var string
     */
    private $key;

    public function __construct(array $config = [])
    {
        $this->key = $config['key'];
        if (empty($this->key)) {
            throw new \InvalidArgumentException('API key is not defined');
        }

        $this->transport = $this->createTransport($config);
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $options
     * @return Response
     */
    public function request(string $method, string $uri, array $options = []): Response
    {
        try {
            $response = $this->transport->request($method, $uri, $options);
        } catch (RequestException $e) {

        } catch (\Throwable $e) {

        }

        return new Response($response);
    }

    /**
     * @param array $config
     * @return ClientInterface
     */
    private function createTransport(array $config): ClientInterface
    {
        $handlerStack = HandlerStack::create();
        $handlerStack->push(
            Middleware::mapRequest(function (RequestInterface $request) {
                return $request
                    ->withHeader('Authorization', 'Bearer ' . $this->key)
                    ->withHeader('Content-Type', 'application/json');
            })
        );

        $configuration = [
            'base_uri' => sprintf('%s/%s/', self::ENDPOINT, $config['version']),
            'handler' => $handlerStack,
        ];

        return new \GuzzleHttp\Client($configuration);
    }
}
