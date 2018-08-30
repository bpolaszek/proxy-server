<?php

namespace App;

use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UriInterface;

final class RequestFactory
{
    /**
     * @var UriInterface
     */
    private $baseUri;

    /**
     * RequestFactory constructor.
     * @param string $baseUri
     * @throws \InvalidArgumentException
     */
    public function __construct(string $baseUri)
    {
        $this->baseUri = new Uri($baseUri);
    }

    /**
     * @param ServerRequestInterface $request
     * @return ServerRequestInterface
     * @throws \InvalidArgumentException
     */
    public function build(ServerRequestInterface $request): ServerRequestInterface
    {
        return $request->withUri(
            $request->getUri()
                ->withScheme($this->baseUri->getScheme())
                ->withUserInfo($this->baseUri->getUserInfo())
                ->withHost($this->baseUri->getHost())
                ->withPort($this->baseUri->getPort())
        );
    }
}
