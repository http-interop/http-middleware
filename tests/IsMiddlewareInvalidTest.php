<?php

namespace Interop\Http\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use ReflectionException;
use Interop\Http\Middleware\Fixtures\Middlewares\Invalid\MagicCall;
use Interop\Http\Middleware\Fixtures\Middlewares\Invalid\PureInvokableDoublePass;
use Interop\Http\Middleware\Fixtures\Middlewares\Invalid\PureInvokableWithDelegate;
use Interop\Http\Middleware\Fixtures\Middlewares\Invalid\PureInvokableWithMixedRequest;
use Interop\Http\Middleware\Fixtures\Middlewares\Invalid\PureInvokableWithoutDelegate;
use Interop\Http\Middleware\Fixtures\Middlewares\Invalid\StaticMiddlewareDoublePass;
use Interop\Http\Middleware\Fixtures\Middlewares\Invalid\StaticMiddlewareWithMixedRequest;
use Interop\Http\Middleware\Fixtures\Middlewares\Invalid\StaticMiddlewareWithoutDelegate;

use function Interop\Http\Middleware\Fixtures\Middlewares\Invalid\fnDoublePassFactory;
use function Interop\Http\Middleware\Fixtures\Middlewares\Invalid\fnWithDelegateFactory;
use function Interop\Http\Middleware\Fixtures\Middlewares\Invalid\fnWithMixedRequestFactory;
use function Interop\Http\Middleware\Fixtures\Middlewares\Invalid\fnWithoutDelegateFactory;

class IsMiddlewareInvalidTest extends \PHPUnit_Framework_TestCase
{
    public function testFnDoublePassShouldBeInvalid()
    {
        $this->assertSame(
            false,
            is_server_middleware('Interop\Http\Middleware\Fixtures\Delegates\Invalid\fnDoublePass')
        );
    }

    public function testFnDoublePassFactoryShouldBeInvalid()
    {
        $sut = fnDoublePassFactory();
        $this->assertSame(false, is_server_middleware($sut));
    }

    public function testFnWithDelegateShouldBeInvalid()
    {
        $this->assertSame(
            false,
            is_server_middleware('Interop\Http\Middleware\Fixtures\Delegates\Invalid\fnWithDelegate')
        );
    }

    public function testFnWithDelegateFactoryShouldBeInvalid()
    {
        $sut = fnWithDelegateFactory();
        $this->assertSame(false, is_server_middleware($sut));
    }

    public function testFnWithMixedRequestShouldBeInvalid()
    {
        $this->assertSame(
            false,
            is_server_middleware('Interop\Http\Middleware\Fixtures\Delegates\Invalid\fnWithMixedRequest')
        );
    }

    public function testFnWithMixedRequestFactoryShouldBeInvalid()
    {
        $sut = fnWithMixedRequestFactory();
        $this->assertSame(false, is_server_middleware($sut));
    }

    public function testFnWithoutDelegateShouldBeInvalid()
    {
        $this->assertSame(
            false,
            is_server_middleware('Interop\Http\Middleware\Fixtures\Delegates\Invalid\fnWithoutDelegate')
        );
    }

    public function testFnWithoutDelegateFactoryShouldBeInvalid()
    {
        $sut = fnWithoutDelegateFactory();
        $this->assertSame(false, is_server_middleware($sut));
    }

    public function magicCallProvider()
    {
        $sut = new MagicCall();

        return [
            [
                [$sut, '__invoke'],
                '/__invoke\(\) does not exist$/',
            ],
            [
                [$sut, 'middleware'],
                '/middleware\(\) does not exist$/',
            ],
            [
                [MagicCall::class, '__invoke'],
                '/__invoke\(\) does not exist$/',
            ],
            [
                MagicCall::class.'::__invoke',
                '/__invoke\(\) does not exist$/',
            ],
            [
                [MagicCall::class, 'middleware'],
                '/middleware\(\) does not exist$/',
            ],
            [
                MagicCall::class.'::middleware',
                '/middleware\(\) does not exist$/',
            ],
        ];
    }

    /**
     * @dataProvider magicCallProvider
     */
    public function testMagicCallShouldBeInvalid($var, $messageRegExp)
    {
        $this->expectException(ReflectionException::class);
        $this->expectExceptionMessageRegExp($messageRegExp);
        is_server_middleware($var);
    }

    public function testPureInvokableDoublePassShouldBeInvalid()
    {
        $sut = new PureInvokableDoublePass();
        $this->assertSame(false, is_server_middleware($sut));
        $this->assertSame(false, is_server_middleware([$sut, '__invoke']));
        $this->assertSame(false, is_server_middleware([PureInvokableDoublePass::class, '__invoke']));
        $this->assertSame(false, is_server_middleware(PureInvokableDoublePass::class.'::__invoke'));
    }

    public function testPureInvokableWithDelegateShouldBeInvalid()
    {
        $sut = new PureInvokableWithDelegate();
        $this->assertSame(false, is_server_middleware($sut));
        $this->assertSame(false, is_server_middleware([$sut, '__invoke']));
        $this->assertSame(false, is_server_middleware([PureInvokableWithDelegate::class, '__invoke']));
        $this->assertSame(false, is_server_middleware(PureInvokableWithDelegate::class.'::__invoke'));
    }

    public function testPureInvokableWithMixedRequestShouldBeInvalid()
    {
        $sut = new PureInvokableWithMixedRequest();
        $this->assertSame(false, is_server_middleware($sut));
        $this->assertSame(false, is_server_middleware([$sut, '__invoke']));
        $this->assertSame(false, is_server_middleware([PureInvokableWithMixedRequest::class, '__invoke']));
        $this->assertSame(false, is_server_middleware(PureInvokableWithMixedRequest::class.'::__invoke'));
    }

    public function testPureInvokableWithoutDelegateShouldBeInvalid()
    {
        $sut = new PureInvokableWithoutDelegate();
        $this->assertSame(false, is_server_middleware($sut));
        $this->assertSame(false, is_server_middleware([$sut, '__invoke']));
        $this->assertSame(false, is_server_middleware([PureInvokableWithoutDelegate::class, '__invoke']));
        $this->assertSame(false, is_server_middleware(PureInvokableWithoutDelegate::class.'::__invoke'));
    }

    public function testStaticMiddlewareDoublePassShouldBeInvalid()
    {
        $sut = new StaticMiddlewareDoublePass();
        $this->assertSame(false, is_server_middleware([$sut, 'delegate']));
        $this->assertSame(false, is_server_middleware([StaticMiddlewareDoublePass::class, 'delegate']));
        $this->assertSame(false, is_server_middleware(StaticMiddlewareDoublePass::class.'::delegate'));
    }

    public function testStaticMiddlewareWithMixedRequestShouldBeInvalid()
    {
        $sut = new StaticMiddlewareWithMixedRequest();
        $this->assertSame(false, is_server_middleware([$sut, 'delegate']));
        $this->assertSame(false, is_server_middleware([StaticMiddlewareDoublePass::class, 'delegate']));
        $this->assertSame(false, is_server_middleware(StaticMiddlewareDoublePass::class.'::delegate'));
    }

    public function testStaticMiddlewareWithoutDelegateShouldBeInvalid()
    {
        $sut = new StaticMiddlewareWithoutDelegate();
        $this->assertSame(false, is_server_middleware([$sut, 'delegate']));
        $this->assertSame(false, is_server_middleware([StaticMiddlewareDoublePass::class, 'delegate']));
        $this->assertSame(false, is_server_middleware(StaticMiddlewareDoublePass::class.'::delegate'));
    }
}
