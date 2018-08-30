[![PPM Compatible](https://raw.githubusercontent.com/php-pm/ppm-badge/master/ppm-badge.png)](https://github.com/php-pm/php-pm)


This small Symfony 4.1 application works as a proxy. 

We assume you have a minimal knowledge of Symfony to customize it to your needs. 

Installation
------------

Clone the current project
```bash
composer create-project bentools/proxy-server my-proxy && cd my-proxy
```

Init your environment variables
```bash
cp .env.dist .env
```

Create your [PHP-PM](https://github.com/php-pm/php-pm) config

```bash
./vendor/bin/ppm config
```

Serve your proxy
```bash
./vendor/bin/ppm start
```

Example configuration
---------------------

```bash
# .env

PROXY_BASE_URI=https://some-api.example.org
```

```json
# ppm.json

{
    "bridge": "HttpKernel",
    "host": "proxied-api.my-server.com",
    "port": 8080,
    "workers": 6,
    "app-env": "prod",
    "debug": 0,
    "logging": 0,
    "static-directory": "",
    "bootstrap": "PHPPM\\Bootstraps\\Symfony",
    "max-requests": 1000,
    "max-execution-time": 0,
    "ttl": 0,
    "populate-server-var": true,
    "socket-path": ".ppm\/run\/",
    "pidfile": ".ppm\/ppm.pid",
    "reload-timeout": 30,
    "cgi-path": "\/etc\/php\/7.2.8\/bin\/php-cgi"
}
```

Now if you try to access `http://proxied-api.my-server.com:8080/some/endpoint?foo=bar` you'll get the response of `https://some-api.example.org/some/endpoint?foo=bar`.

Throttling
----------

Enable [throttling](https://github.com/bpolaszek/guzzle-throttle-middleware) via your environment variables:

```bash
# .env

PROXY_ENABLE_THROTTLING=true
PROXY_THROTTLING_MAX_REQUESTS=50
PROXY_THROTTLING_DURATION=10
```

This way you'll ensure than a maximum of 50 requests will be transferred to the real host in a 10 seconds window. All other requests will be delayed. 
Counting requests is shared via Redis, but feel free to implement a storage of your own.
