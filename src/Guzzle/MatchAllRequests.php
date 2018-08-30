<?php

namespace App\Guzzle;

use BenTools\Psr7\RequestMatcherInterface;
use Psr\Http\Message\RequestInterface;

final class MatchAllRequests implements RequestMatcherInterface
{

    /**
     * @inheritDoc
     */
    public function matchRequest(RequestInterface $request)
    {
        return true;
    }
}
