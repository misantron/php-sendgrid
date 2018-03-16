<?php

namespace Misantron\SendGrid\Api;


use Psr\Http\Message\ResponseInterface;

/**
 * Class Response
 * @package Misantron\SendGrid\Api
 */
class Response
{
    /**
     * @var ResponseInterface
     */
    private $origin;

    /**
     * @var array
     */
    private $data;

    /**
     * @param ResponseInterface $origin
     */
    public function __construct(ResponseInterface $origin)
    {
        $this->origin = $origin;
        $this->data = $this->getDataFromResponse($origin);
    }

    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param ResponseInterface $response
     * @return array
     */
    private function getDataFromResponse(ResponseInterface $response): array
    {
        $contents = $response->getBody()->getContents();
        return \GuzzleHttp\json_decode($contents, true);
    }
}