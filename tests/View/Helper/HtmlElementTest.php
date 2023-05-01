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

namespace Mimmi20Test\LaminasView\Helper\HtmlElement\View\Helper;

use Laminas\Config\Config;
use Laminas\View\Helper\EscapeHtml;
use Laminas\View\Helper\EscapeHtmlAttr;
use Mimmi20\LaminasView\Helper\HtmlElement\View\Helper\HtmlElement;
use PHPUnit\Framework\Exception;
use PHPUnit\Framework\TestCase;

final class HtmlElementTest extends TestCase
{
    /** @throws Exception */
    public function testOpen(): void
    {
        $expected = '<a id="testIdEscaped" classEscaped="testClassEscaped" hrefEscaped="#Escaped" targetEscaped="_blankEscaped" onClick=\'{"a":"b"}\' data-test="test-class1 test-class2">';

        $id       = 'testId';
        $class    = 'test-class';
        $href     = '#';
        $target   = '_blank';
        $onclick  = (object) ['a' => 'b'];
        $testData = ['test-class1', 'test-class2'];

        $escapeHtml = $this->getMockBuilder(EscapeHtml::class)
            ->disableOriginalConstructor()
            ->getMock();
        $escapeHtml->expects(self::exactly(6))
            ->method('__invoke')
            ->willReturnMap(
                [
                    ['id', 0, 'id'],
                    ['class', 0, 'classEscaped'],
                    ['href', 0, 'hrefEscaped'],
                    ['target', 0, 'targetEscaped'],
                    ['onClick', 0, 'onClick'],
                    ['data-test', 0, 'data-test'],
                ],
            );

        $escapeHtmlAttr = $this->getMockBuilder(EscapeHtmlAttr::class)
            ->disableOriginalConstructor()
            ->getMock();
        $escapeHtmlAttr->expects(self::exactly(5))
            ->method('__invoke')
            ->willReturnMap(
                [
                    [$id, 0, 'testIdEscaped'],
                    [$class, 0, 'testClassEscaped'],
                    [$href, 0, '#Escaped'],
                    [$target, 0, '_blankEscaped'],
                    ['test-class1 test-class2', 0, 'test-class1 test-class2'],
                ],
            );

        $element = 'a';

        $htmlElement = new HtmlElement($escapeHtml, $escapeHtmlAttr);

        self::assertSame(
            $expected,
            $htmlElement->openTag(
                $element,
                ['id' => $id, 'title' => '', 'class' => $class, 'href' => $href, 'target' => $target, 'onClick' => $onclick, 'data-test' => $testData],
            ),
        );
    }

    /** @throws Exception */
    public function testToHtmlIgnoringNullAttributes(): void
    {
        $expected = '<a id="testIdEscaped" classEscaped="testClassEscaped" hrefEscaped="#Escaped" targetEscaped="_blankEscaped" onClick=\'{"a":"b"}\' data-test="test-class1 test-class2">';

        $id       = 'testId';
        $class    = 'test-class';
        $href     = '#';
        $target   = '_blank';
        $onclick  = (object) ['a' => 'b'];
        $testData = ['test-class1', 'test-class2'];

        $escapeHtml = $this->getMockBuilder(EscapeHtml::class)
            ->disableOriginalConstructor()
            ->getMock();
        $escapeHtml->expects(self::exactly(6))
            ->method('__invoke')
            ->willReturnMap(
                [
                    ['id', 0, 'id'],
                    ['class', 0, 'classEscaped'],
                    ['href', 0, 'hrefEscaped'],
                    ['target', 0, 'targetEscaped'],
                    ['onClick', 0, 'onClick'],
                    ['data-test', 0, 'data-test'],
                ],
            );

        $escapeHtmlAttr = $this->getMockBuilder(EscapeHtmlAttr::class)
            ->disableOriginalConstructor()
            ->getMock();
        $escapeHtmlAttr->expects(self::exactly(5))
            ->method('__invoke')
            ->willReturnMap(
                [
                    [$id, 0, 'testIdEscaped'],
                    [$class, 0, 'testClassEscaped'],
                    [$href, 0, '#Escaped'],
                    [$target, 0, '_blankEscaped'],
                    ['test-class1 test-class2', 0, 'test-class1 test-class2'],
                ],
            );

        $element = 'a';

        $htmlElement = new HtmlElement($escapeHtml, $escapeHtmlAttr);

        self::assertSame(
            $expected,
            $htmlElement->openTag(
                $element,
                ['id' => $id, 'title' => '', 'class' => $class, 'href' => $href, 'target' => $target, 'onClick' => $onclick, 'data-test' => $testData, 'open' => null],
            ),
        );
    }

    /** @throws Exception */
    public function testOpenNotIgnoringTrueAttributes(): void
    {
        $expected = '<a id="testIdEscaped" classEscaped="testClassEscaped" hrefEscaped="#Escaped" targetEscaped="_blankEscaped" onClick=\'{"a":"b"}\' data-test="test-class1 test-class2" openEscaped>';

        $id       = 'testId';
        $class    = 'test-class';
        $href     = '#';
        $target   = '_blank';
        $onclick  = (object) ['a' => 'b'];
        $testData = ['test-class1', 'test-class2'];

        $escapeHtml = $this->getMockBuilder(EscapeHtml::class)
            ->disableOriginalConstructor()
            ->getMock();
        $escapeHtml->expects(self::exactly(7))
            ->method('__invoke')
            ->willReturnMap(
                [
                    ['id', 0, 'id'],
                    ['class', 0, 'classEscaped'],
                    ['href', 0, 'hrefEscaped'],
                    ['target', 0, 'targetEscaped'],
                    ['onClick', 0, 'onClick'],
                    ['data-test', 0, 'data-test'],
                    ['open', 0, 'openEscaped'],
                ],
            );

        $escapeHtmlAttr = $this->getMockBuilder(EscapeHtmlAttr::class)
            ->disableOriginalConstructor()
            ->getMock();
        $escapeHtmlAttr->expects(self::exactly(5))
            ->method('__invoke')
            ->willReturnMap(
                [
                    [$id, 0, 'testIdEscaped'],
                    [$class, 0, 'testClassEscaped'],
                    [$href, 0, '#Escaped'],
                    [$target, 0, '_blankEscaped'],
                    ['test-class1 test-class2', 0, 'test-class1 test-class2'],
                ],
            );

        $element = 'a';

        $htmlElement = new HtmlElement($escapeHtml, $escapeHtmlAttr);

        self::assertSame(
            $expected,
            $htmlElement->openTag(
                $element,
                ['id' => $id, 'title' => '', 'class' => $class, 'href' => $href, 'target' => $target, 'onClick' => $onclick, 'data-test' => $testData, 'open' => true],
            ),
        );
    }

    /** @throws Exception */
    public function testClose(): void
    {
        $expected = '</a>';

        $escapeHtml = $this->getMockBuilder(EscapeHtml::class)
            ->disableOriginalConstructor()
            ->getMock();
        $escapeHtml->expects(self::never())
            ->method('__invoke');

        $escapeHtmlAttr = $this->getMockBuilder(EscapeHtmlAttr::class)
            ->disableOriginalConstructor()
            ->getMock();
        $escapeHtmlAttr->expects(self::never())
            ->method('__invoke');

        $element = 'a';

        $htmlElement = new HtmlElement($escapeHtml, $escapeHtmlAttr);

        self::assertSame(
            $expected,
            $htmlElement->closeTag($element),
        );
    }

    /** @throws Exception */
    public function testInvoke(): void
    {
        $escapeHtml = $this->getMockBuilder(EscapeHtml::class)
            ->disableOriginalConstructor()
            ->getMock();
        $escapeHtml->expects(self::never())
            ->method('__invoke');

        $escapeHtmlAttr = $this->getMockBuilder(EscapeHtmlAttr::class)
            ->disableOriginalConstructor()
            ->getMock();
        $escapeHtmlAttr->expects(self::never())
            ->method('__invoke');

        $htmlElement = new HtmlElement($escapeHtml, $escapeHtmlAttr);

        self::assertSame($htmlElement, ($htmlElement)());
    }

    /** @throws Exception */
    public function testOpenWithIntAttributes(): void
    {
        $expected = '<a id="testIdEscaped" classEscaped="testClassEscaped" hrefEscaped="#Escaped" targetEscaped="_blankEscaped" onClick=\'{"a":"b"}\' data-test="test-class1 test-class2" openEscaped valueEscaped="0">';

        $id       = 'testId';
        $class    = 'test-class';
        $href     = '#';
        $target   = '_blank';
        $onclick  = (object) ['a' => 'b'];
        $testData = ['test-class1', 'test-class2'];
        $value    = 0;

        $escapeHtml = $this->getMockBuilder(EscapeHtml::class)
            ->disableOriginalConstructor()
            ->getMock();
        $escapeHtml->expects(self::exactly(8))
            ->method('__invoke')
            ->willReturnMap(
                [
                    ['id', 0, 'id'],
                    ['class', 0, 'classEscaped'],
                    ['href', 0, 'hrefEscaped'],
                    ['target', 0, 'targetEscaped'],
                    ['onClick', 0, 'onClick'],
                    ['data-test', 0, 'data-test'],
                    ['open', 0, 'openEscaped'],
                    ['value', 0, 'valueEscaped'],
                ],
            );

        $escapeHtmlAttr = $this->getMockBuilder(EscapeHtmlAttr::class)
            ->disableOriginalConstructor()
            ->getMock();
        $escapeHtmlAttr->expects(self::exactly(6))
            ->method('__invoke')
            ->willReturnMap(
                [
                    [$id, 0, 'testIdEscaped'],
                    [$class, 0, 'testClassEscaped'],
                    [$href, 0, '#Escaped'],
                    [$target, 0, '_blankEscaped'],
                    ['test-class1 test-class2', 0, 'test-class1 test-class2'],
                    [(string) $value, 0, (string) $value],
                ],
            );

        $element = 'a';

        $htmlElement = new HtmlElement($escapeHtml, $escapeHtmlAttr);

        self::assertSame(
            $expected,
            $htmlElement->openTag(
                $element,
                ['id' => $id, 'title' => '', 'class' => $class, 'href' => $href, 'target' => $target, 'onClick' => $onclick, 'data-test' => $testData, 'open' => true, 'value' => $value, 'xxx'],
            ),
        );
    }

    /** @throws Exception */
    public function testOpenWithConfigAttributes(): void
    {
        $expected = '<a id="testIdEscaped" classEscaped="testClassEscaped" hrefEscaped="#Escaped" targetEscaped="_blankEscaped" onClick=\'{"a":"b"}\' data-test="test-class1 test-class2" openEscaped valueEscaped="0">';

        $id       = 'testId';
        $class    = 'test-class';
        $href     = '#';
        $target   = '_blank';
        $onclick  = (object) ['a' => 'b'];
        $testData = new Config(['test-class1', 'test-class2']);
        $value    = 0;

        $escapeHtml = $this->getMockBuilder(EscapeHtml::class)
            ->disableOriginalConstructor()
            ->getMock();
        $escapeHtml->expects(self::exactly(8))
            ->method('__invoke')
            ->willReturnMap(
                [
                    ['id', 0, 'id'],
                    ['class', 0, 'classEscaped'],
                    ['href', 0, 'hrefEscaped'],
                    ['target', 0, 'targetEscaped'],
                    ['onClick', 0, 'onClick'],
                    ['data-test', 0, 'data-test'],
                    ['open', 0, 'openEscaped'],
                    ['value', 0, 'valueEscaped'],
                ],
            );

        $escapeHtmlAttr = $this->getMockBuilder(EscapeHtmlAttr::class)
            ->disableOriginalConstructor()
            ->getMock();
        $escapeHtmlAttr->expects(self::exactly(6))
            ->method('__invoke')
            ->willReturnMap(
                [
                    [$id, 0, 'testIdEscaped'],
                    [$class, 0, 'testClassEscaped'],
                    [$href, 0, '#Escaped'],
                    [$target, 0, '_blankEscaped'],
                    ['test-class1 test-class2', 0, 'test-class1 test-class2'],
                    [(string) $value, 0, (string) $value],
                ],
            );

        $element = 'a';

        $htmlElement = new HtmlElement($escapeHtml, $escapeHtmlAttr);

        self::assertSame(
            $expected,
            $htmlElement->openTag(
                $element,
                ['id' => $id, 'title' => '', 'class' => $class, 'href' => $href, 'target' => $target, 'onClick' => $onclick, 'data-test' => $testData, 'open' => true, 'value' => $value, 'xxx'],
            ),
        );
    }
}
