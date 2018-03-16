<?php

namespace Misantron\SendGrid\Resource;


use Misantron\SendGrid\Api\Response;

/**
 * Class Mail
 * @package Misantron\SendGrid\Resource
 */
class Mail extends Resource
{
    public function send(array $settings): Response
    {
        $uri = $this->uri('mail/send');
        $options = ['json' => $settings];

        return $this->client->request('post', $uri, $options);
    }
}