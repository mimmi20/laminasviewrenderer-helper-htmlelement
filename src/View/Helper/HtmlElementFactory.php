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

namespace Mimmi20\LaminasView\Helper\HtmlElement\View\Helper;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Laminas\View\Helper\EscapeHtml;
use Laminas\View\Helper\EscapeHtmlAttr;
use Laminas\View\HelperPluginManager as ViewHelperPluginManager;
use Psr\Container\ContainerExceptionInterface;

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
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array | null $options = null,
    ): HtmlElement {
        $plugin = $container->get(ViewHelperPluginManager::class);

        assert($plugin instanceof ViewHelperPluginManager);

        $html = $plugin->get(EscapeHtml::class);
        $attr = $plugin->get(EscapeHtmlAttr::class);

        assert($html instanceof EscapeHtml);
        assert($attr instanceof EscapeHtmlAttr);

        return new HtmlElement($html, $attr);
    }
}
