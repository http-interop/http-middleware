<?php

namespace Interop\Http\Middleware\Fixtures\Middlewares\Invalid;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class StaticMiddlewareDoublePass
{
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public static function middleware(ServerRequestInterface $request, ResponseInterface $response)
    {
        return $response;
    }
}
