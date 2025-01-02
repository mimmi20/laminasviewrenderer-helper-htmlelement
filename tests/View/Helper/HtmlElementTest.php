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

namespace Mimmi20Test\LaminasView\Helper\HtmlElement\View\Helper;

use JsonException;
use Laminas\View\Helper\HtmlAttributes;
use Mimmi20\LaminasView\Helper\HtmlElement\View\Helper\HtmlElement;
use PHPUnit\Framework\Exception;
use PHPUnit\Framework\TestCase;

final class HtmlElementTest extends TestCase
{
    /**
     * @throws Exception
     * @throws JsonException
     */
    public function testOpen(): void
    {
        $expected = '<a id="testId" class="test-class" href="&#x23;" target="_blank" onClick="&#x7B;&quot;a&quot;&#x3A;&quot;b&quot;&#x7D;" data-test="test-class1&#x20;test-class2">';

        $id       = 'testId';
        $class    = 'test-class';
        $href     = '#';
        $target   = '_blank';
        $onclick  = ['a' => 'b'];
        $testData = ['test-class1', 'test-class2'];

        $htmlAttributes = new HtmlAttributes();

        $element = 'a';

        $htmlElement = new HtmlElement($htmlAttributes);

        self::assertSame(
            $expected,
            $htmlElement->openTag(
                $element,
                ['id' => $id, 'class' => $class, 'href' => $href, 'target' => $target, 'onClick' => $onclick, 'data-test' => $testData],
            ),
        );
    }

    /** @throws Exception */
    public function testClose(): void
    {
        $expected = '</a>';

        $htmlAttributes = new HtmlAttributes();

        $element = 'a';

        $htmlElement = new HtmlElement($htmlAttributes);

        self::assertSame(
            $expected,
            $htmlElement->closeTag($element),
        );
    }

    /** @throws Exception */
    public function testInvoke(): void
    {
        $htmlAttributes = new HtmlAttributes();

        $htmlElement = new HtmlElement($htmlAttributes);

        self::assertSame($htmlElement, ($htmlElement)());
    }
}
