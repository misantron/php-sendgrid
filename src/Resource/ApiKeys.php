<?php

namespace Misantron\SendGrid\Resource;


use Misantron\SendGrid\Api\Response;

/**
 * Class ApiKeys
 * @package Misantron\SendGrid\Resource
 */
class ApiKeys extends Resource
{
    public function getAll(int $limit = 0): Response
    {
        $uri = $this->uri('/api_keys');

        $options = [];
        if ($limit > 0) {
            $options['query'] = $this->query([
                'limit' => $limit
            ]);
        }

        return $this->client->request('get', $uri, $options);
    }
}