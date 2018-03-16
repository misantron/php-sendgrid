<?php

namespace Misantron\SendGrid\Api;


use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Psr\Http\Message\RequestInterface;

/**
 * Class Client
 * @package Misantron\SendGrid\Api
 */
class Client
{
    private const ENDPOINT = 'https://api.sendgrid.com/';

    /**
     * @var ClientInterface
     */
    protected $transport;

    /**
     * @var string
     */
    private $version;

    /**
     * @var string
     */
    private $key;

    /**
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->key = $config['key'] ?? getenv('SENDGRID_KEY');
        $this->version = $config['version'] ?? 'v3';

        if (empty($this->key)) {
            throw new \InvalidArgumentException();
        }

        $this->transport = $this->createTransport();
    }

    public function request(string $method, string $uri, array $options = []): Response
    {
        try {
            $response = $this->transport->request($method, $uri, $options);
            return new Response($response);
        } catch (BadResponseException $e) {

        } catch (\Exception $e) {

        }

    }

    /**
     * @return ClientInterface
     */
    private function createTransport(): ClientInterface
    {
        $handlerStack = HandlerStack::create();
        $handlerStack->push(
            Middleware::mapRequest(function (RequestInterface $request) {
                return $request
                    ->withHeader('Authorization', 'Bearer ' . $this->key)
                    ->withHeader('Content-Type', 'application/json');
            })
        );

        return new \GuzzleHttp\Client([
            'base_uri' => self::ENDPOINT,
            'handler' => $handlerStack,
        ]);
    }
}