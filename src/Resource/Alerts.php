<?php

namespace Misantron\SendGrid\Resource;


use Misantron\SendGrid\Api\Response;

/**
 * Class Alerts
 * @package Misantron\SendGrid\Resource
 */
class Alerts extends Resource
{
    /**
     * @return string
     */
    protected function basePath(): string
    {
        return 'alerts';
    }

    /**
     * @return Response
     */
    public function getAll(): Response
    {
        return $this->client->request('get', $this->basePath());
    }

    /**
     * @param int $id
     * @return Response
     */
    public function get(int $id): Response
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
            ->setRequired(['type', 'email_to'])
            ->setDefined(['frequency', 'percentage'])
            ->setAllowedTypes('type', 'string')
            ->setAllowedValues('type', ['stats_notification', 'usage_limit'])
            ->setAllowedTypes('email_to', ['string', 'null'])
            ->setAllowedTypes('frequency', 'string')
            ->setAllowedValues('frequency', ['daily', 'weekly', 'monthly'])
            ->setAllowedTypes('percentage', 'integer')
            ->resolve($data);

        $options = ['json' => $data];

        return $this->client->request('post', $this->basePath(), $options);
    }

    /**
     * @param int $id
     * @param array $data
     * @return Response
     */
    public function update(int $id, array $data): Response
    {
        $this->getResolver()
            ->setDefined(['email_to', 'frequency', 'percentage'])
            ->setAllowedTypes('email_to', 'string')
            ->setAllowedTypes('frequency', 'string')
            ->setAllowedValues('frequency', ['daily', 'weekly', 'monthly'])
            ->setAllowedTypes('percentage', 'integer')
            ->resolve($data);

        $options = ['json' => $data];

        return $this->client->request('patch', $this->basePath() . '/' . $id, $options);
    }

    /**
     * @param int $id
     * @return Response
     */
    public function delete(int $id): Response
    {
        return $this->client->request('delete', $this->basePath() . '/' . $id);
    }
}