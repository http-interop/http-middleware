<?php

namespace Interop\Http\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Interop\Http\Middleware\Fixtures\Delegates\Valid\PureInvokable;
use Interop\Http\Middleware\Fixtures\Delegates\Valid\Delegate;
use Interop\Http\Middleware\Fixtures\Delegates\Valid\StaticDelegate;

use function Interop\Http\Middleware\Fixtures\Delegates\Valid\fnDelegateFactory;

class IsDelegateValidTest extends \PHPUnit_Framework_TestCase
{
    public function testFnDelegateShouldBeValid()
    {
        $this->assertSame(
            true,
            is_delegate('Interop\Http\Middleware\Fixtures\Delegates\Valid\fnDelegate')
        );
    }

    public function testFnDelegateFactoryShouldBeValid()
    {
        $sut = fnDelegateFactory();
        $this->assertSame(true, is_delegate($sut));
    }

    public function testPureInvokableShouldBeValid()
    {
        $sut = new PureInvokable();
        $this->assertSame(true, is_delegate($sut));
        $this->assertSame(true, is_delegate([$sut, '__invoke']));
    }

    public function testDelegateShouldBeValid()
    {
        $sut = new Delegate();
        $this->assertSame(true, is_delegate($sut));
        $this->assertSame(true, is_delegate([$sut, '__invoke']));
    }

    public function testStaticDelegateShouldBeValid()
    {
        $sut = new StaticDelegate();
        $this->assertSame(true, is_delegate([$sut, 'Delegate']));
        $this->assertSame(true, is_delegate([StaticDelegate::class, 'delegate']));
        $this->assertSame(true, is_delegate(StaticDelegate::class.'::delegate'));
    }
}
