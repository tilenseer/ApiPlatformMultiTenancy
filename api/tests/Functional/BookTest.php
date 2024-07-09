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
                'Content-Type' => 'application/ld+json'
            ],
            'json' => [
                'name' => 'The Lord of the Rings',
            ]
        ]);

        self::assertResponseIsSuccessful();
    }
}
