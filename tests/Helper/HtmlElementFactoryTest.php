<?php
/**
 * This file is part of the mimmi20/laminasviewrenderer-helper-htmlelement package.
 *
 * Copyright (c) 2021-2023, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Mimmi20Test\LaminasView\Helper\HtmlElement\Helper;

use Interop\Container\ContainerInterface;
use Laminas\View\Helper\EscapeHtml;
use Laminas\View\Helper\EscapeHtmlAttr;
use Laminas\View\HelperPluginManager;
use Mimmi20\LaminasView\Helper\HtmlElement\Helper\HtmlElement;
use Mimmi20\LaminasView\Helper\HtmlElement\Helper\HtmlElementFactory;
use PHPUnit\Framework\Exception;
use PHPUnit\Framework\TestCase;

use function assert;

final class HtmlElementFactoryTest extends TestCase
{
    private HtmlElementFactory $factory;

    /** @throws void */
    protected function setUp(): void
    {
        $this->factory = new HtmlElementFactory();
    }

    /** @throws Exception */
    public function testInvocation(): void
    {
        $escapeHtml     = $this->createMock(EscapeHtml::class);
        $escapeHtmlAttr = $this->createMock(EscapeHtmlAttr::class);

        $helperPluginManager = $this->getMockBuilder(HelperPluginManager::class)
            ->disableOriginalConstructor()
            ->getMock();
        $helperPluginManager->expects(self::exactly(2))
            ->method('get')
            ->willReturnMap(
                [
                    [EscapeHtml::class, null, $escapeHtml],
                    [EscapeHtmlAttr::class, null, $escapeHtmlAttr],
                ],
            );
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
