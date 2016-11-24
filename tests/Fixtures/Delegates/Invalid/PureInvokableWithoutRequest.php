<?php

namespace Interop\Http\Middleware\Fixtures\Delegates\Invalid;

class PureInvokableWithoutRequest
{
    public function __invoke()
    {
        return null;
    }
}
