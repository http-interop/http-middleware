<?php

namespace Interop\Http\Middleware\Fixtures\Delegates\Invalid;

class MagicCall
{
    public function __call($name, $arguments)
    {
        if ($name === '__invoke') {
            return null;
        }

        if ($name === 'delegate') {
            return null;
        }
    }

    public static function __callStatic($name, $arguments)
    {
        if ($name === '__invoke') {
            return null;
        }

        if ($name === 'delegate') {
            return null;
        }
    }
}
