<?php
namespace App\Tests\Functional;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\User;
use Hautelook\AliceBundle\PhpUnit\ReloadDatabaseTrait;
use App\Test\CustomApiTestCase;

//class BucketListingResourceTest extends ApiTestCase {
class BucketListingResourceTest extends CustomApiTestCase {
    use ReloadDatabaseTrait;

    public function testCreateBucketListing()
    {
        $this->assertEquals(42, 42);
    }

    public function testCreateBucketList()
    {
        $client = self::createClient();

        $this->createUser('cheeseplease@example.com', '$argon2id$v=19$m=65536,t=6,p=1$AIC3IESQ64NgHfpVQZqviw$1c7M56xyiaQFBjlUBc7T0s53/PzZCjV56lbHnhOUXx8');

        $client->request('POST', '/api/bucket_lists', [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => [
                'name' => 'from phpUnit2',
                'description' => 'phpUnit description2',
                'owner' => '/api/users/1'
            ]
        ]);
        $this->assertResponseStatusCodeSame(201);

        $client->request('POST', '/api/bucket_lists', [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => [],
        ]);
        $this->assertResponseStatusCodeSame(400);


    }
}
