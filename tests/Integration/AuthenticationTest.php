<?php

namespace FtwSoft\Rundeck\Tests\Integration;

use FtwSoft\Rundeck\Authentication\PasswordAuthentication;
use FtwSoft\Rundeck\Authentication\TokenAuthentication;
use FtwSoft\Rundeck\Client;
use GuzzleHttp\Client as HttpClient;
use Http\Factory\Guzzle\RequestFactory;
use Http\Factory\Guzzle\StreamFactory;
use PHPUnit\Framework\TestCase;

class AuthenticationTest extends TestCase
{
    public function testPasswordAuthentication()
    {
        $httpClient = new HttpClient();

        $authentication = new PasswordAuthentication(
            getenv('RUNDECK_HOST'),
            getenv('RUNDECK_USERNAME'),
            getenv('RUNDECK_PASSWORD'),
            $httpClient,
            new RequestFactory(),
            new StreamFactory()
        );

        $client = new Client(getenv('RUNDECK_HOST'), $httpClient, new RequestFactory(), new StreamFactory(), 26);
        $client->setAuthentication($authentication);
        $this->testAuthenticatedClient($client);
    }

    public function testTokenAuthentication()
    {
        $httpClient = new HttpClient();

        $client = new Client(getenv('RUNDECK_HOST'), $httpClient, new RequestFactory(), new StreamFactory(), 26);
        $client->setAuthentication(new TokenAuthentication(getenv('RUNDECK_API_TOKEN')));
        $this->testAuthenticatedClient($client);

        $client->setAuthentication(new TokenAuthentication('invalidToken'));
        $this->assertEquals(403, $client->get('system/info')->getStatusCode());
    }

    private function testAuthenticatedClient(Client $client)
    {
        $systemInfoResponse = $client->get('system/info');
        $systemInfoData = json_decode($systemInfoResponse->getBody()->getContents(), true);

        $this->assertEquals(200, $systemInfoResponse->getStatusCode());
        $this->assertIsArray($systemInfoData);
        $this->assertArrayHasKey('system', $systemInfoData);
    }
}