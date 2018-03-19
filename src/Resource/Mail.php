<?php

namespace Misantron\SendGrid\Resource;


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
        $options = ['json' => $settings];

        return $this->client->request('post', $this->basePath() . '/send', $options);
    }
}