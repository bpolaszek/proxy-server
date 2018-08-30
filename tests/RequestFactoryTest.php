<?php

namespace App\Tests;

use App\RequestFactory;
use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;

class RequestFactoryTest extends TestCase
{

    public function testBuild()
    {
        $factory = new RequestFactory('https://my-awesome-app.com');
        $request = new ServerRequest('GET', 'http://www.my-proxied-app.com:8080/api/foo/bar');
        $this->assertEquals('https://my-awesome-app.com/api/foo/bar', (string) $factory->build($request)->getUri());
    }
}
