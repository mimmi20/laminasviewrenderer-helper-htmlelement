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

namespace Mimmi20\LaminasView\Helper\HtmlElement\Helper;

use JsonException;
use Laminas\View\Helper\HtmlAttributes;

use function sprintf;

trait HtmlElementTrait
{
    /** @throws void */
    public function __construct(private readonly HtmlAttributes $htmlAttributes)
    {
        // nothing to do
    }

    /**
     * Generate an opening tag
     *
     * @phpstan-param iterable<string, array<mixed>|bool|float|int|string|null> $attribs
     *
     * @throws JsonException
     */
    private function open(string $element, iterable $attribs): string
    {
        return sprintf('<%s%s>', $element, ($this->htmlAttributes)($attribs));
    }

    /**
     * Return a closing tag
     *
     * @throws void
     */
    private function close(string $element): string
    {
        return sprintf('</%s>', $element);
    }
}
