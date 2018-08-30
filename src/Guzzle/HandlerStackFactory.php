<?php

namespace App\Guzzle;

use BenTools\GuzzleHttp\Middleware\ThrottleMiddleware;
use GuzzleHttp\HandlerStack;

final class HandlerStackFactory
{
    /**
     * @inheritDoc
     */
    public function __invoke(ThrottleMiddleware $throttleMiddleware, bool $enableThrottling): HandlerStack
    {
        $stack = HandlerStack::create();
        $stack->remove('http_errors');

        if ($enableThrottling) {
            $stack->push($throttleMiddleware, 'throttling');
        }

        return $stack;
    }
}
