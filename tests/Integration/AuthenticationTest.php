<?php

namespace FtwSoft\Rundeck\Tests\Integration;

use FtwSoft\Rundeck\Authentication\PasswordAuthentication;
use FtwSoft\Rundeck\Authentication\TokenAuthentication;
use FtwSoft\Rundeck\Client;
use FtwSoft\Rundeck\Exception\AuthenticationException;
use GuzzleHttp\Client as HttpClient;
use Http\Factory\Guzzle\RequestFactory;
use Http\Factory\Guzzle\StreamFactory;
use PHPUnit\Framework\TestCase;

class AuthenticationTest extends TestCase
{
    /**
     * @var string
     */
    private $rundeckHost;

    /**
     * @var string
     */
    private $rundeckUser;

    /**
     * @var string
     */
    private $rundeckPassword;

    /**
     * @var string
     */
    private $rundeckApiToken;

    protected function setUp(): void
    {
        $this->rundeckHost = getenv('RUNDECK_HOST');
        $this->rundeckUser = getenv('RUNDECK_USERNAME');
        $this->rundeckPassword = getenv('RUNDECK_PASSWORD');
        $this->rundeckApiToken = getenv('RUNDECK_API_TOKEN');
    }

    public function testPasswordAuthentication(): void
    {
        $httpClient = new HttpClient();

        $authentication = new PasswordAuthentication(
            $this->rundeckHost,
            $this->rundeckUser,
            $this->rundeckPassword,
            $httpClient,
            new RequestFactory(),
            new StreamFactory()
        );

        $client = new Client(
            $this->rundeckHost,
            $authentication,
            $httpClient,
            new RequestFactory(),
            new StreamFactory(),
            26
        );
        $this->testAuthenticatedClient($client);
    }

    public function testInvalidPasswordAuthentication(): void
    {
        $this->expectException(AuthenticationException::class);
        $httpClient = new HttpClient();

        $authentication = new PasswordAuthentication(
            $this->rundeckHost,
            'invalidUser',
            'invalidPassword',
            $httpClient,
            new RequestFactory(),
            new StreamFactory()
        );

        $client = new Client(
            $this->rundeckHost,
            $authentication,
            $httpClient,
            new RequestFactory(),
            new StreamFactory(),
            26
        );
        $client->get('system/info');
    }

    public function testTokenAuthentication(): void
    {
        $httpClient = new HttpClient();

        $client = new Client(
            $this->rundeckHost,
            new TokenAuthentication($this->rundeckApiToken),
            $httpClient,
            new RequestFactory(),
            new StreamFactory(),
            26
        );
        $this->testAuthenticatedClient($client);
    }

    public function testInvalidTokenAuthentication(): void
    {
        $httpClient = new HttpClient();

        $client = new Client(
            $this->rundeckHost,
            new TokenAuthentication('invalidToken'),
            $httpClient,
            new RequestFactory(),
            new StreamFactory(),
            26
        );

        $this->assertEquals(403, $client->get('system/info')->getStatusCode());
    }

    private function testAuthenticatedClient(Client $client): void
    {
        $systemInfoResponse = $client->get('system/info');
        $systemInfoData = json_decode($systemInfoResponse->getBody()->getContents(), true);

        $this->assertEquals(200, $systemInfoResponse->getStatusCode());
        $this->assertIsArray($systemInfoData);
        $this->assertArrayHasKey('system', $systemInfoData);
    }
}