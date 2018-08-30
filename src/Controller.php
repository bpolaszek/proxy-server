<?php

namespace App;

use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class Controller
{
    /**
     * @var ClientInterface
     */
    private $guzzle;

    /**
     * @var RequestFactory
     */
    private $requestFactory;

    /**
     * Controller constructor.
     * @param ClientInterface $guzzle
     */
    public function __construct(ClientInterface $guzzle, RequestFactory $requestFactory)
    {
        $this->guzzle = $guzzle;
        $this->requestFactory = $requestFactory;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $request = $this->requestFactory->build($request);
        return $this->guzzle->send($request);
    }
}
