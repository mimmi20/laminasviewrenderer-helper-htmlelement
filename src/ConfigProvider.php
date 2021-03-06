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

namespace Mimmi20\LaminasView\Helper\HtmlElement;

final class ConfigProvider
{
    /**
     * Return general-purpose laminas-navigation configuration.
     *
     * @return array<string, array<string, array<string, string>>>
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencyConfig(),
            'view_helpers' => $this->getViewHelperConfig(),
        ];
    }

    /**
     * Return application-level dependency configuration.
     *
     * @return array<string, array<string, string>>
     */
    public function getDependencyConfig(): array
    {
        return [
            'factories' => [
                Helper\HtmlElement::class => Helper\HtmlElementFactory::class,
            ],
            'aliases' => [
                Helper\HtmlElementInterface::class => Helper\HtmlElement::class,
            ],
        ];
    }

    /**
     * @return array<string, array<string, string>>
     */
    public function getViewHelperConfig(): array
    {
        return [
            'factories' => [
                View\Helper\HtmlElement::class => View\Helper\HtmlElementFactory::class,
            ],
            'aliases' => [
                'htmlElement' => View\Helper\HtmlElement::class,
            ],
        ];
    }
}
