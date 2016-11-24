<?php

namespace Interop\Http\Middleware\Fixtures\Delegates\Invalid;

class StaticDelegateWithoutRequest
{
    public static function delegate()
    {
        return null;
    }
}
