<?php

/**
 * This file is part of the mimmi20/laminasviewrenderer-helper-htmlelement package.
 *
 * Copyright (c) 2021-2025, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Mimmi20Test\LaminasView\Helper\HtmlElement;

use Mimmi20\LaminasView\Helper\HtmlElement\ConfigProvider;
use Mimmi20\LaminasView\Helper\HtmlElement\Helper\HtmlElementInterface;
use Mimmi20\LaminasView\Helper\HtmlElement\View\Helper\HtmlElement;
use PHPUnit\Framework\Exception;
use PHPUnit\Framework\TestCase;

final class ConfigProviderTest extends TestCase
{
    /** @throws Exception */
    public function testReturnedArrayContainsDependencies(): void
    {
        $config = (new ConfigProvider())();
        self::assertIsArray($config);
        self::assertCount(2, $config);

        self::assertArrayHasKey('dependencies', $config);

        $dependencies = $config['dependencies'];
        self::assertIsArray($dependencies);
        self::assertCount(2, $dependencies);
        self::assertArrayHasKey('factories', $dependencies);

        $factories = $dependencies['factories'];
        self::assertIsArray($factories);
        self::assertCount(1, $factories);
        self::assertArrayHasKey(
            \Mimmi20\LaminasView\Helper\HtmlElement\Helper\HtmlElement::class,
            $factories,
        );

        self::assertArrayHasKey('aliases', $dependencies);

        $aliases = $dependencies['aliases'];
        self::assertIsArray($aliases);
        self::assertCount(1, $aliases);
        self::assertArrayHasKey(HtmlElementInterface::class, $aliases);

        self::assertArrayHasKey('view_helpers', $config);
        $viewHelpers = $config['view_helpers'];
        self::assertIsArray($viewHelpers);
        self::assertCount(2, $viewHelpers);
        self::assertArrayHasKey('factories', $viewHelpers);

        $factories = $viewHelpers['factories'];
        self::assertIsArray($factories);
        self::assertCount(1, $factories);
        self::assertArrayHasKey(HtmlElement::class, $factories);

        $aliases = $viewHelpers['aliases'];
        self::assertIsArray($aliases);
        self::assertCount(1, $aliases);
        self::assertArrayHasKey('htmlElement', $aliases);
    }

    /** @throws Exception */
    public function testReturnedArrayContainsDependencies2(): void
    {
        $dependencies = (new ConfigProvider())->getDependencyConfig();
        self::assertIsArray($dependencies);
        self::assertCount(2, $dependencies);
        self::assertArrayHasKey('factories', $dependencies);

        $factories = $dependencies['factories'];
        self::assertIsArray($factories);
        self::assertCount(1, $factories);
        self::assertArrayHasKey(
            \Mimmi20\LaminasView\Helper\HtmlElement\Helper\HtmlElement::class,
            $factories,
        );

        self::assertArrayHasKey('aliases', $dependencies);

        $aliases = $dependencies['aliases'];
        self::assertIsArray($aliases);
        self::assertCount(1, $aliases);
        self::assertArrayHasKey(HtmlElementInterface::class, $aliases);
    }

    /** @throws Exception */
    public function testReturnedArrayContainsViewhelpers(): void
    {
        $viewHelpers = (new ConfigProvider())->getViewHelperConfig();
        self::assertIsArray($viewHelpers);
        self::assertCount(2, $viewHelpers);
        self::assertArrayHasKey('factories', $viewHelpers);

        $factories = $viewHelpers['factories'];
        self::assertIsArray($factories);
        self::assertCount(1, $factories);
        self::assertArrayHasKey(HtmlElement::class, $factories);

        $aliases = $viewHelpers['aliases'];
        self::assertIsArray($aliases);
        self::assertCount(1, $aliases);
        self::assertArrayHasKey('htmlElement', $aliases);
    }
}
