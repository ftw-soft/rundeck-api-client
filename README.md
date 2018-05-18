Rundeck API client
==================

PHP API to access Rundeck API

Based on documentation at http://rundeck.org/docs/api/index.html

Api is not complete. Not all of the functions are available

Requirements
============
PHP 5.6+

Rundeck 2.1+

curl-ext form GuzzleHttp client implementation

Suggest to install guzzlehttp/guzzle 6 version to implement the standard http client

Installation
============

Through the composer

```bash
composer require ftw-soft/rundeck-api-client
```

To use the standard package's http client implementation you must install GuzzleHttp client

```bash
composer require guzzlehttp/guzzle:^6.3
```

Or you could create your own http client

```php
<?php
namespace App\Rundeck;

use FtwSoft\Rundeck\HttpClient\HttpClientInterface;

class MyHttpClient implements HttpClientInterface
{
    /**
     * @inheritDoc
     */
    public function request($method, $uri, array $json = []) {
        // implement your own client
        // the method could contain GET, POST, DELETE etc.
        // The uri is using resource/function syntax
        // Must return \Psr\Http\Message\ResponseInterface instance
    }
    
}
```

Creating client
===============

```php
<?php
use FtwSoft\Rundeck\ClientFactory;

require_once __DIR__ . '/vendor/autoload.php';

// Client with token authentication

$client = ClientFactory::createClient('https://rundeck-domain.com', 'TOKEN');

// Client with password authentication
$client = ClientFactory::createClient('https://rundeck-domain.com', 'username', 'password');


// Make a request

$response = $client->request('GET', 'projects');

var_dump($response->getBody()->getContents());

```

Resources
=========

At this time I've created Resource classes for suc Rundeck resources based on API documentation
- Execution
- Job
- Project
- Projects
- System
- Token
- Tokens
- User

This resources implements some of the API functions and creates on class entities based on JSON which represents in

For example

```php
<?php
use FtwSoft\Rundeck\ClientFactory;
use FtwSoft\Rundeck\Resource\Tokens as TokensResource;
use FtwSoft\Rundeck\Entity\TokenEntity;

require_once __DIR__ . '/vendor/autoload.php';

// Client with token authentication

$client = ClientFactory::createClient('https://rundeck-domain.com', 'TOKEN');

$tokensResource = new TokensResource($client);

/** @var TokenEntity[] $tokens */
$tokens = $tokensResource->get();

foreach ($tokens as $token) {
    echo '====================================';
    echo 'id: ', $token->getId(), PHP_EOL;
    echo 'user:', $token->getUser(), PHP_EOL;
    echo 'token: ', $token->getToken(), PHP_EOL;
    echo 'creator: ', $token->getCreator(), PHP_EOL;
    echo 'expire at: ', $token->getExpiration()->format(\DATE_ATOM), PHP_EOL;
    echo 'roles: ', implode(', ', $token->getRoles()), PHP_EOL;
    echo 'is expired: ', $token->isExpired() ? 'yes' : 'no', PHP_EOL;
}

```

You could also create your own resources and entities for it's result and create a pull request