<?php

namespace Interop\Http\Middleware\Fixtures\Middlewares\Invalid;

class PureInvokableWithMixedRequest
{
    public function __invoke($request, callable $delegate)
    {
        return $delegate($request);
    }
}
