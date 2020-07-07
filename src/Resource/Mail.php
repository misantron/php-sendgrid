<?php

declare(strict_types=1);

namespace Misantron\SendGrid\Resource;

use GuzzleHttp\RequestOptions;
use Misantron\SendGrid\Api\Response;

/**
 * Class Mail
 * @package Misantron\SendGrid\Resource
 */
class Mail extends Resource
{
    /**
     * @return string
     */
    protected function basePath(): string
    {
        return 'mail';
    }

    /**
     * @param array $settings
     * @return Response
     */
    public function send(array $settings): Response
    {
        $options = [RequestOptions::JSON => $settings];

        return $this->client->request('post', $this->basePath() . '/send', $options);
    }
}
