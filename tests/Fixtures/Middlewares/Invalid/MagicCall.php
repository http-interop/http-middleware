<?php

namespace Interop\Http\Middleware\Fixtures\Middlewares\Invalid;

class MagicCall
{
    public function __call($name, $arguments)
    {
        if ($name === '__invoke') {
            $delegate = $arguments[1];

            return $delegate($arguments[0]);
        }

        if ($name === 'delegate') {
            $delegate = $arguments[1];

            return $delegate($arguments[0]);
        }
    }

    public static function __callStatic($name, $arguments)
    {
        if ($name === '__invoke') {
            $delegate = $arguments[1];

            return $delegate($arguments[0]);
        }

        if ($name === 'delegate') {
            $delegate = $arguments[1];

            return $delegate($arguments[0]);
        }
    }
}
