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

use Laminas\Json\Json;
use Laminas\View\Exception\InvalidArgumentException;
use Laminas\View\Helper\EscapeHtml;
use Laminas\View\Helper\EscapeHtmlAttr;
use stdClass;
use Traversable;

use function array_filter;
use function assert;
use function implode;
use function is_iterable;
use function is_scalar;
use function is_string;
use function iterator_to_array;
use function mb_strlen;
use function mb_strpos;
use function sprintf;
use function str_starts_with;

trait HtmlElementTrait
{
    /** @throws void */
    public function __construct(
        private readonly EscapeHtml $escapeHtml,
        private readonly EscapeHtmlAttr $escapeHtmlAttr,
    ) {
        // nothing to do
    }

    /**
     * Generate an opening tag
     *
     * @phpstan-param array<int|string, (array<int, string>|bool|float|int|iterable<int, string>|stdClass|string|null)> $attribs
     *
     * @throws InvalidArgumentException
     */
    private function open(string $element, array $attribs): string
    {
        return sprintf('<%s%s>', $element, $this->htmlAttribs($attribs));
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

    /**
     * Converts an associative array to a string of tag attributes.
     *
     * @phpstan-param array<int|string, (array<int, string>|bool|float|int|iterable<int, string>|stdClass|string|null)> $attribs an array where each key-value pair is converted
     *                                                                                                      to an attribute name and value
     *
     * @throws InvalidArgumentException
     */
    private function htmlAttribs(array $attribs): string
    {
        // filter out empty string values
        $attribs = array_filter(
            $attribs,
            static fn ($value): bool => $value !== null && (!is_string($value) || mb_strlen($value)),
        );

        $xhtml = '';

        foreach ($attribs as $key => $val) {
            if (!is_string($key)) {
                continue;
            }

            $key = ($this->escapeHtml)($key);

            assert(is_string($key));

            if ($val === true) {
                $xhtml .= ' ' . $key;

                continue;
            }

            if (str_starts_with($key, 'on') || ($key === 'constraints') || $val instanceof stdClass) {
                // Don't escape event attributes; _do_ substitute double quotes with singles
                if (!is_scalar($val)) {
                    // non-scalar data should be cast to JSON first
                    $val = Json::encode($val);
                }
            } else {
                if (is_iterable($val)) {
                    if ($val instanceof Traversable) {
                        $val = iterator_to_array($val);
                    }

                    $val = implode(' ', $val);
                } elseif (!is_string($val)) {
                    $val = (string) $val;
                }

                assert(is_string($val));

                $val = ($this->escapeHtmlAttr)($val);
            }

            assert(is_string($val));

            if (mb_strpos($val, '"') !== false) {
                $xhtml .= sprintf(' %s=\'%s\'', $key, $val);
            } else {
                $xhtml .= sprintf(' %s="%s"', $key, $val);
            }
        }

        return $xhtml;
    }
}
