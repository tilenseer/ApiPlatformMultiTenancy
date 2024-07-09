<?php

namespace App\Tests\Functional;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;

class BookTest extends ApiTestCase
{
    public function testCreateBook(): void
    {
        $client = static::createClient();

        $client->request('POST', '/demo/books', [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'name' => 'The Lord of the Rings',
            ]
        ]);

        dump($client->getResponse()->getContent());

        self::assertResponseIsSuccessful();
    }

    public function testGetBook(): void
    {
        $client = static::createClient();

        $client->request('GET', '/demo/books/5', [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
        ]);

        dump($client->getResponse()->getContent());

        self::assertResponseIsSuccessful();
    }
}
