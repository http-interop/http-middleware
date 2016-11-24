#!/usr/bin/env php
<?php

namespace SmokeTest;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;

require __DIR__.'/../vendor/autoload.php';

/**
 * @todo find PHP 5.3+ test harness
 */
class TapProducer
{
    private $planned = 0;
    private $tests;

    public function add($descr, $test) {
        $this->tests[$descr] = $test;
        $this->planned++;
    }

    function run() {
        $planned = $this->planned;
        $runned = 0;
        $failed = 0;

        echo '1..'.$planned.PHP_EOL;

        foreach($this->tests as $descr => $test) {
            if ($test()) {
                $result = 'ok';
            } else {
                $result = 'not ok';
                $failed++;
            }
            $runned++;
            echo $result.' '.$runned.' - '.$descr.PHP_EOL;
        }

        return $failed;
    }
}

$t = new TapProducer();

$t->add('delegate', function () {
    return true === \Interop\Http\Middleware\is_delegate(function (RequestInterface $request) {
        return null;
    });
});

$t->add('not delegate', function () {
    return false === \Interop\Http\Middleware\is_delegate(function ($request) {
        return null;
    });
});

$t->add('middleware', function () {
    return true === \Interop\Http\Middleware\is_server_middleware(function (ServerRequestInterface $request, callable $delegate) {
        return $delegate($request);
    });
});

$t->add('non middleware', function () {
    return false === \Interop\Http\Middleware\is_server_middleware(function ($request, $delegate) {
        return $delegate($request);
    });
});

exit($t->run());
