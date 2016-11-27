<?php

namespace Interop\Http\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use Interop\Http\Middleware\Fixtures\Middlewares\Valid\Middleware;
use Interop\Http\Middleware\Fixtures\Middlewares\Valid\PureInvokable;
use Interop\Http\Middleware\Fixtures\Middlewares\Valid\StaticMiddleware;

use function Interop\Http\Middleware\Fixtures\Middlewares\Valid\fnMiddlewareFactory;

class IsMiddlewareValidTest extends \PHPUnit_Framework_TestCase
{
    public function testFnMiddlewareShouldBeValid()
    {
        $this->assertSame(
            true,
            is_server_middleware('Interop\Http\Middleware\Fixtures\Middlewares\Valid\fnMiddleware')
        );
    }

    public function testFnMiddlewareFactoryShouldBeValid()
    {
        $sut = fnMiddlewareFactory();
        $this->assertSame(true, is_server_middleware($sut));
    }

    public function testMiddlewareShouldBeValid()
    {
        $sut = new Middleware();
        $this->assertSame(true, is_server_middleware($sut));
        $this->assertSame(true, is_server_middleware([$sut, '__invoke']));
    }

    public function testPureInvokableWithCallableShouldBeValid()
    {
        $sut = new PureInvokable();
        $this->assertSame(true, is_server_middleware($sut));
        $this->assertSame(true, is_server_middleware([$sut, '__invoke']));
    }

    public function testStaticMiddlewareShouldBeValid()
    {
        $sut = new StaticMiddleware();
        $this->assertSame(true, is_server_middleware([$sut, 'middleware']));
        $this->assertSame(true, is_server_middleware([StaticMiddleware::class, 'middleware']));
        $this->assertSame(true, is_server_middleware(StaticMiddleware::class.'::middleware'));
    }
}
