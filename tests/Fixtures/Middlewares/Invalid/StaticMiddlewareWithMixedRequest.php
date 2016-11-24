<?php

namespace Interop\Http\Middleware\Fixtures\Middlewares\Invalid;

class StaticMiddlewareWithMixedRequest
{
    public static function middleware($request, callable $delegate)
    {
        return $delegate($request);
    }
}
