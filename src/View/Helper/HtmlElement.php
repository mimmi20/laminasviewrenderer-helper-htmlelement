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

namespace Mimmi20\LaminasView\Helper\HtmlElement\View\Helper;

use Laminas\View\Exception\InvalidArgumentException;
use Laminas\View\Helper\AbstractHelper;
use Mimmi20\LaminasView\Helper\HtmlElement\Helper\HtmlElementTrait;
use stdClass;

final class HtmlElement extends AbstractHelper
{
    use HtmlElementTrait;

    /** @throws void */
    public function __invoke(): self
    {
        return $this;
    }

    /**
     * Generate an opening tag
     *
     * @phpstan-param array<int|string, (array<int, string>|bool|float|int|iterable<int, string>|stdClass|string|null)> $attribs
     *
     * @throws InvalidArgumentException
     *
     * @api
     */
    public function openTag(string $element, array $attribs): string
    {
        return $this->open($element, $attribs);
    }

    /**
     * Return a closing tag
     *
     * @throws void
     *
     * @api
     */
    public function closeTag(string $element): string
    {
        return $this->close($element);
    }
}
