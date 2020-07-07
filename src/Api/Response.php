<?php

declare(strict_types=1);

namespace Misantron\SendGrid\Api;

use Psr\Http\Message\ResponseInterface;

/**
 * Class Response
 * @package Misantron\SendGrid\Api
 */
class Response
{
    /**
     * @var array
     */
    private $data;

    /**
     * @param ResponseInterface $origin
     */
    public function __construct(ResponseInterface $origin)
    {
        $this->data = $this->getDataFromResponse($origin);
    }

    /**
     * @return array
     */
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
