<?php

namespace Interop\Http\Middleware\Fixtures\Delegates\Invalid;

class PureInvokableWithMixedRequest
{
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function __invoke($request)
    {
        return null;
    }
}
