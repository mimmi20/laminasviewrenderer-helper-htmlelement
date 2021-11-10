<?php
/**
 * This file is part of the mimmi20/laminasviewrenderer-helper-htmlelement package.
 *
 * Copyright (c) 2021, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Mimmi20\LaminasView\Helper\HtmlElement\Helper;

use Interop\Container\ContainerInterface;
use Laminas\View\Helper\EscapeHtml;
use Laminas\View\Helper\EscapeHtmlAttr;
use Laminas\View\HelperPluginManager as ViewHelperPluginManager;
use Psr\Container\ContainerExceptionInterface;

use function assert;

final class HtmlElementFactory
{
    /**
     * @throws ContainerExceptionInterface
     */
    public function __invoke(ContainerInterface $container): HtmlElement
    {
        $plugin = $container->get(ViewHelperPluginManager::class);

        assert($plugin instanceof ViewHelperPluginManager);

        $html = $plugin->get(EscapeHtml::class);
        $attr = $plugin->get(EscapeHtmlAttr::class);

        assert($html instanceof EscapeHtml);
        assert($attr instanceof EscapeHtmlAttr);

        return new HtmlElement($html, $attr);
    }
}
