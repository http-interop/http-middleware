<?php

namespace Interop\Http\Middleware\Fixtures\Delegates\Invalid;

class StaticDelegateWithMixedRequest
{
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public static function delegate($request)
    {
        return null;
    }
}
