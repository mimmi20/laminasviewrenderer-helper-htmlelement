<?php

/**
 * This file is part of the mimmi20/laminasviewrenderer-helper-htmlelement package.
 *
 * Copyright (c) 2021-2024, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Mimmi20Test\LaminasView\Helper\HtmlElement\View\Helper;

use Laminas\View\Helper\HtmlAttributes;
use Laminas\View\HelperPluginManager;
use Mimmi20\LaminasView\Helper\HtmlElement\View\Helper\HtmlElement;
use Mimmi20\LaminasView\Helper\HtmlElement\View\Helper\HtmlElementFactory;
use Override;
use PHPUnit\Framework\Exception;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;

use function assert;

final class HtmlElementFactoryTest extends TestCase
{
    private HtmlElementFactory $factory;

    /** @throws void */
    #[Override]
    protected function setUp(): void
    {
        $this->factory = new HtmlElementFactory();
    }

    /**
     * @throws Exception
     * @throws ContainerExceptionInterface
     */
    public function testInvocation(): void
    {
        $htmlAttributes = $this->createMock(HtmlAttributes::class);

        $helperPluginManager = $this->getMockBuilder(HelperPluginManager::class)
            ->disableOriginalConstructor()
            ->getMock();
        $helperPluginManager->expects(self::once())
            ->method('get')
            ->with(HtmlAttributes::class, null)
            ->willReturn($htmlAttributes);
        $helperPluginManager->expects(self::never())
            ->method('has');

        $container = $this->getMockBuilder(ContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $container->expects(self::once())
            ->method('get')
            ->with(HelperPluginManager::class)
            ->willReturn($helperPluginManager);

        assert($container instanceof ContainerInterface);
        $helper = ($this->factory)($container, '');

        self::assertInstanceOf(HtmlElement::class, $helper);
    }
}
