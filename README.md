# Rundeck API client

A php client to access the Rundeck API, based on the [official documentation](https://docs.rundeck.com/api/rundeck-api.html).
Not all API functions are represented by default.

## Requirements

* PHP 7.2+ with enabled json extension
* Rundeck 2.1+

This client is based on [PSR-17](https://www.php-fig.org/psr/psr-17/) and [PSR-18](https://www.php-fig.org/psr/psr-18/)
and therefore you need a compatible HTTP client and request factories.

We suggest [Guzzle 7+](https://github.com/guzzle/guzzle) and [`http-interop/http-factory-guzzle`](https://github.com/http-interop/http-factory-guzzle):
```bash
composer require guzzlehttp/guzzle:^7.0 http-interop/http-factory-guzzle:^1.0
```

## Installation

```bash
composer require ftw-soft/rundeck-api-client
```

## Basic client usage

```php
<?php
require_once __DIR__ . '/vendor/autoload.php';

use FtwSoft\Rundeck\Authentication\PasswordAuthentication;
use FtwSoft\Rundeck\Authentication\TokenAuthentication;
use FtwSoft\Rundeck\Client;
use GuzzleHttp\Client as HttpClient;
use Http\Factory\Guzzle\RequestFactory;
use Http\Factory\Guzzle\StreamFactory;

$httpClient = new HttpClient();

// --- Setup authentication ---
# Password authentication
$authentication = new PasswordAuthentication(
    'https://rundeck.local',
    'username',
    'password',
    $httpClient,
    new RequestFactory(),
    new StreamFactory()
);

# OR Token based authentication
$authentication = new TokenAuthentication('secret-token');

// --- Initialize client ---
$client = new Client(
    'https://rundeck.local',
    $authentication,
    $httpClient,
    new RequestFactory(),
    new StreamFactory(),
    36 // optional API version
);

// Make a request
$response = $client->request('GET', 'projects');
var_dump($response->getBody()->getContents());
```

## Supported default scenarios

This package includes common request scenarios which are called "resources".
The following resources are currently supported:
- Execution
- Job
- Project
- Projects
- System
- Token
- Tokens
- User

Each resource includes calls to the API and it's payload and/or response is represented by custom entity classes.

For example

```php
<?php
require_once __DIR__ . '/vendor/autoload.php';

use FtwSoft\Rundeck\Resource\Tokens as TokensResource;
use FtwSoft\Rundeck\Client;
use FtwSoft\Rundeck\Entity\TokenEntity;

/** @var Client $client */
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

Feel free to add your own resources and entities to this package by creating a new [pull request](https://github.com/ftw-soft/rundeck-api-client/pulls).