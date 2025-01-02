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

namespace Mimmi20\LaminasView\Helper\HtmlElement\View\Helper;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Laminas\View\Helper\HtmlAttributes;
use Laminas\View\HelperPluginManager as ViewHelperPluginManager;
use Override;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;

use function assert;

final class HtmlElementFactory implements FactoryInterface
{
    /**
     * @param  string $requestedName
     *
     * @throws ContainerExceptionInterface
     *
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
     * @phpcsSuppress SlevomatCodingStandard.Functions.UnusedParameter.UnusedParameter
     */
    #[Override]
    public function __invoke(ContainerInterface $container, $requestedName, array | null $options = null): HtmlElement
    {
        $plugin = $container->get(ViewHelperPluginManager::class);

        assert($plugin instanceof ViewHelperPluginManager);

        $htmlAttributes = $plugin->get(HtmlAttributes::class);

        assert($htmlAttributes instanceof HtmlAttributes);

        return new HtmlElement($htmlAttributes);
    }
}
