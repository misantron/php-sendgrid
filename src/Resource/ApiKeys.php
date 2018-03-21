<?php

namespace Misantron\SendGrid\Resource;


use Misantron\SendGrid\Api\Response;

/**
 * Class ApiKeys
 * @package Misantron\SendGrid\Resource
 */
class ApiKeys extends Resource
{
    /**
     * @return string
     */
    protected function basePath(): string
    {
        return 'api_keys';
    }

    /**
     * @param int $limit
     * @return Response
     */
    public function getAll(int $limit = 0): Response
    {
        $options = [];
        if ($limit > 0) {
            $options['query'] = $this->query([
                'limit' => $limit
            ]);
        }

        return $this->client->request('get', $this->basePath(), $options);
    }

    /**
     * @param string $id
     * @return Response
     */
    public function get(string $id): Response
    {
        return $this->client->request('get', $this->basePath() . '/' . $id);
    }

    /**
     * @param array $data
     * @return Response
     */
    public function create(array $data): Response
    {
        $this->getResolver()
            ->setRequired(['name'])
            ->setDefined(['scopes', 'sample'])
            ->setAllowedTypes('name', 'string')
            ->setAllowedTypes('scopes', 'string[]')
            ->setAllowedTypes('sample', 'string')
            ->resolve($data);

        $options = ['json' => $data];

        return $this->client->request('post', $this->basePath(), $options);
    }

    /**
     * @param string $id
     * @param string $name
     * @return Response
     */
    public function updateName(string $id, string $name): Response
    {
        $options = ['json' => ['name' => $name]];

        return $this->client->request('patch', $this->basePath() . '/' . $id, $options);
    }

    /**
     * @param string $id
     * @param array $data
     * @return Response
     */
    public function update(string $id, array $data): Response
    {
        $this->getResolver()
            ->setDefined(['name', 'scopes'])
            ->setAllowedTypes('name', 'string')
            ->setAllowedTypes('scopes', 'string[]')
            ->resolve($data);

        $options = ['json' => $data];

        return $this->client->request('put', $this->basePath() . '/' . $id, $options);
    }

    /**
     * @param string $id
     * @return Response
     */
    public function delete(string $id): Response
    {
        return $this->client->request('delete', $this->basePath() . '/' . $id);
    }
}