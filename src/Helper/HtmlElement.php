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

namespace Mimmi20\LaminasView\Helper\HtmlElement\Helper;

use Laminas\View\Exception\InvalidArgumentException;
use stdClass;

final class HtmlElement implements HtmlElementInterface
{
    use HtmlElementTrait;

    /**
     * Returns an HTML string
     *
     * @phpstan-param array<int|string, (array<int, string>|bool|float|int|iterable<int, string>|stdClass|string|null)> $attribs
     *
     * @return string HTML string
     *
     * @throws InvalidArgumentException
     */
    public function toHtml(string $element, array $attribs, string $content): string
    {
        return $this->open($element, $attribs) . $content . $this->close($element);
    }
}
