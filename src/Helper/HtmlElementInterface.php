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

interface HtmlElementInterface
{
    /**
     * Returns an HTML string
     *
     * @phpstan-param array<string, array<string>|bool|float|int|iterable|string|null> $attribs
     *
     * @return string HTML string
     */
    public function toHtml(string $element, array $attribs, string $content): string;
}
