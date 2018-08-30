<?php

namespace App\Guzzle;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\HandlerStack;

final class ClientFactory
{
    public function __invoke(HandlerStack $stack): ClientInterface
    {
        return new Client([
            'handler' => $stack
        ]);
    }
}
