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

namespace Mimmi20Test\LaminasView\Helper\HtmlElement\Helper;

use Laminas\Config\Config;
use Laminas\View\Exception\InvalidArgumentException;
use Laminas\View\Helper\EscapeHtml;
use Laminas\View\Helper\EscapeHtmlAttr;
use Mimmi20\LaminasView\Helper\HtmlElement\Helper\HtmlElement;
use PHPUnit\Framework\Exception;
use PHPUnit\Framework\TestCase;

final class HtmlElementTest extends TestCase
{
    /**
     * @throws Exception
     * @throws InvalidArgumentException
     */
    public function testToHtml(): void
    {
        $expected = '<a id="testIdEscaped" classEscaped="testClassEscaped" hrefEscaped="#Escaped" targetEscaped="_blankEscaped" onClick=\'{"a":"b"}\' data-test="test-class1 test-class2">testLabelTranslatedAndEscaped</a>';

        $escapedTranslatedLabel = 'testLabelTranslatedAndEscaped';
        $id                     = 'testId';
        $class                  = 'test-class';
        $href                   = '#';
        $target                 = '_blank';
        $onclick                = (object) ['a' => 'b'];
        $testData               = ['test-class1', 'test-class2'];

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
            $htmlElement->toHtml(
                $element,
                ['id' => $id, 'title' => '', 'class' => $class, 'href' => $href, 'target' => $target, 'onClick' => $onclick, 'data-test' => $testData],
                $escapedTranslatedLabel,
            ),
        );
    }

    /**
     * @throws Exception
     * @throws InvalidArgumentException
     */
    public function testToHtmlIgnoringNullAttributes(): void
    {
        $expected = '<a id="testIdEscaped" classEscaped="testClassEscaped" hrefEscaped="#Escaped" targetEscaped="_blankEscaped" onClick=\'{"a":"b"}\' data-test="test-class1 test-class2">testLabelTranslatedAndEscaped</a>';

        $escapedTranslatedLabel = 'testLabelTranslatedAndEscaped';
        $id                     = 'testId';
        $class                  = 'test-class';
        $href                   = '#';
        $target                 = '_blank';
        $onclick                = (object) ['a' => 'b'];
        $testData               = ['test-class1', 'test-class2'];

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
            $htmlElement->toHtml(
                $element,
                ['id' => $id, 'title' => '', 'class' => $class, 'href' => $href, 'target' => $target, 'onClick' => $onclick, 'data-test' => $testData, 'open' => null],
                $escapedTranslatedLabel,
            ),
        );
    }

    /**
     * @throws Exception
     * @throws InvalidArgumentException
     */
    public function testToHtmlNotIgnoringTrueAttributes(): void
    {
        $expected = '<a id="testIdEscaped" classEscaped="testClassEscaped" hrefEscaped="#Escaped" targetEscaped="_blankEscaped" onClick=\'{"a":"b"}\' constraints="abc" data-test="test-class1 test-class2" openEscaped vonEscaped="xyzEscaped">testLabelTranslatedAndEscaped</a>';

        $escapedTranslatedLabel = 'testLabelTranslatedAndEscaped';
        $id                     = 'testId';
        $class                  = 'test-class';
        $href                   = '#';
        $target                 = '_blank';
        $onclick                = (object) ['a' => 'b'];
        $testData               = ['test-class1', 'test-class2'];

        $escapeHtml = $this->getMockBuilder(EscapeHtml::class)
            ->disableOriginalConstructor()
            ->getMock();
        $escapeHtml->expects(self::exactly(9))
            ->method('__invoke')
            ->willReturnMap(
                [
                    ['id', 0, 'id'],
                    ['class', 0, 'classEscaped'],
                    ['href', 0, 'hrefEscaped'],
                    ['target', 0, 'targetEscaped'],
                    ['onClick', 0, 'onClick'],
                    ['constraints', 0, 'constraints'],
                    ['data-test', 0, 'data-test'],
                    ['open', 0, 'openEscaped'],
                    ['von', 0, 'vonEscaped'],
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
                    ['xyz', 0, 'xyzEscaped'],
                ],
            );

        $element = 'a';

        $htmlElement = new HtmlElement($escapeHtml, $escapeHtmlAttr);

        self::assertSame(
            $expected,
            $htmlElement->toHtml(
                $element,
                ['id' => $id, 'title' => '', 'class' => $class, 'href' => $href, 'target' => $target, 'onClick' => $onclick, 'constraints' => 'abc', 'data-test' => $testData, 'open' => true, 'von' => 'xyz'],
                $escapedTranslatedLabel,
            ),
        );
    }

    /**
     * @throws Exception
     * @throws InvalidArgumentException
     */
    public function testOpenWithIntAttributes(): void
    {
        $expected = '<a id="testIdEscaped" classEscaped="testClassEscaped" hrefEscaped="#Escaped" targetEscaped="_blankEscaped" onClick=\'{"a":"b"}\' constraints="abc" data-test="test-class1 test-class2" openEscaped valueEscaped="0" vonEscaped="xyzEscaped">testLabelTranslatedAndEscaped</a>';

        $escapedTranslatedLabel = 'testLabelTranslatedAndEscaped';
        $id                     = 'testId';
        $class                  = 'test-class';
        $href                   = '#';
        $target                 = '_blank';
        $onclick                = (object) ['a' => 'b'];
        $testData               = ['test-class1', 'test-class2'];
        $value                  = 0;

        $escapeHtml = $this->getMockBuilder(EscapeHtml::class)
            ->disableOriginalConstructor()
            ->getMock();
        $escapeHtml->expects(self::exactly(10))
            ->method('__invoke')
            ->willReturnMap(
                [
                    ['id', 0, 'id'],
                    ['class', 0, 'classEscaped'],
                    ['href', 0, 'hrefEscaped'],
                    ['target', 0, 'targetEscaped'],
                    ['onClick', 0, 'onClick'],
                    ['constraints', 0, 'constraints'],
                    ['data-test', 0, 'data-test'],
                    ['open', 0, 'openEscaped'],
                    ['value', 0, 'valueEscaped'],
                    ['von', 0, 'vonEscaped'],
                ],
            );

        $escapeHtmlAttr = $this->getMockBuilder(EscapeHtmlAttr::class)
            ->disableOriginalConstructor()
            ->getMock();
        $escapeHtmlAttr->expects(self::exactly(7))
            ->method('__invoke')
            ->willReturnMap(
                [
                    [$id, 0, 'testIdEscaped'],
                    [$class, 0, 'testClassEscaped'],
                    [$href, 0, '#Escaped'],
                    [$target, 0, '_blankEscaped'],
                    ['test-class1 test-class2', 0, 'test-class1 test-class2'],
                    [(string) $value, 0, (string) $value],
                    ['xyz', 0, 'xyzEscaped'],
                ],
            );

        $element = 'a';

        $htmlElement = new HtmlElement($escapeHtml, $escapeHtmlAttr);

        self::assertSame(
            $expected,
            $htmlElement->toHtml(
                $element,
                ['id' => $id, 'title' => '', 'class' => $class, 'href' => $href, 'target' => $target, 'onClick' => $onclick, 'constraints' => 'abc', 'data-test' => $testData, 'xxx', 'open' => true, 'value' => $value, 'von' => 'xyz'],
                $escapedTranslatedLabel,
            ),
        );
    }

    /**
     * @throws Exception
     * @throws InvalidArgumentException
     */
    public function testOpenWithConfigAttributes(): void
    {
        $expected = '<a id="testIdEscaped" classEscaped="testClassEscaped" hrefEscaped="#Escaped" targetEscaped="_blankEscaped" onClick=\'{"a":"b"}\' constraints="abc" data-test="test-class1 test-class2" openEscaped valueEscaped="0" vonEscaped="xyzEscaped">testLabelTranslatedAndEscaped</a>';

        $escapedTranslatedLabel = 'testLabelTranslatedAndEscaped';
        $id                     = 'testId';
        $class                  = 'test-class';
        $href                   = '#';
        $target                 = '_blank';
        $onclick                = (object) ['a' => 'b'];
        $testData               = new Config(['test-class1', 'test-class2']);
        $value                  = 0;

        $escapeHtml = $this->getMockBuilder(EscapeHtml::class)
            ->disableOriginalConstructor()
            ->getMock();
        $escapeHtml->expects(self::exactly(10))
            ->method('__invoke')
            ->willReturnMap(
                [
                    ['id', 0, 'id'],
                    ['class', 0, 'classEscaped'],
                    ['href', 0, 'hrefEscaped'],
                    ['target', 0, 'targetEscaped'],
                    ['onClick', 0, 'onClick'],
                    ['constraints', 0, 'constraints'],
                    ['data-test', 0, 'data-test'],
                    ['open', 0, 'openEscaped'],
                    ['value', 0, 'valueEscaped'],
                    ['von', 0, 'vonEscaped'],
                ],
            );

        $escapeHtmlAttr = $this->getMockBuilder(EscapeHtmlAttr::class)
            ->disableOriginalConstructor()
            ->getMock();
        $escapeHtmlAttr->expects(self::exactly(7))
            ->method('__invoke')
            ->willReturnMap(
                [
                    [$id, 0, 'testIdEscaped'],
                    [$class, 0, 'testClassEscaped'],
                    [$href, 0, '#Escaped'],
                    [$target, 0, '_blankEscaped'],
                    ['test-class1 test-class2', 0, 'test-class1 test-class2'],
                    [(string) $value, 0, (string) $value],
                    ['xyz', 0, 'xyzEscaped'],
                ],
            );

        $element = 'a';

        $htmlElement = new HtmlElement($escapeHtml, $escapeHtmlAttr);

        self::assertSame(
            $expected,
            $htmlElement->toHtml(
                $element,
                ['id' => $id, 'title' => '', 'class' => $class, 'href' => $href, 'target' => $target, 'onClick' => $onclick, 'constraints' => 'abc', 'data-test' => $testData, 'xxx', 'open' => true, 'value' => $value, 'von' => 'xyz'],
                $escapedTranslatedLabel,
            ),
        );
    }

    /**
     * @throws Exception
     * @throws InvalidArgumentException
     */
    public function testOpenWithConfigAttributes2(): void
    {
        $expected = '<a id="testIdEscaped" classEscaped="testClassEscaped" hrefEscaped="#Escaped" targetEscaped="_blankEscaped" data-click-escaped=\'{"a":"b"}\' data-test="test-class1 test-class2" openEscaped valueEscaped="0" vonEscaped="xyzEscaped">testLabelTranslatedAndEscaped</a>';

        $escapedTranslatedLabel = 'testLabelTranslatedAndEscaped';
        $id                     = 'testId';
        $class                  = 'test-class';
        $href                   = '#';
        $target                 = '_blank';
        $onclick                = (object) ['a' => 'b'];
        $testData               = new Config(['test-class1', 'test-class2']);
        $value                  = 0;

        $escapeHtml = $this->getMockBuilder(EscapeHtml::class)
            ->disableOriginalConstructor()
            ->getMock();
        $escapeHtml->expects(self::exactly(9))
            ->method('__invoke')
            ->willReturnMap(
                [
                    ['id', 0, 'id'],
                    ['class', 0, 'classEscaped'],
                    ['href', 0, 'hrefEscaped'],
                    ['target', 0, 'targetEscaped'],
                    ['data-click', 0, 'data-click-escaped'],
                    ['data-test', 0, 'data-test'],
                    ['open', 0, 'openEscaped'],
                    ['value', 0, 'valueEscaped'],
                    ['von', 0, 'vonEscaped'],
                ],
            );

        $escapeHtmlAttr = $this->getMockBuilder(EscapeHtmlAttr::class)
            ->disableOriginalConstructor()
            ->getMock();
        $escapeHtmlAttr->expects(self::exactly(7))
            ->method('__invoke')
            ->willReturnMap(
                [
                    [$id, 0, 'testIdEscaped'],
                    [$class, 0, 'testClassEscaped'],
                    [$href, 0, '#Escaped'],
                    [$target, 0, '_blankEscaped'],
                    ['test-class1 test-class2', 0, 'test-class1 test-class2'],
                    [(string) $value, 0, (string) $value],
                    ['xyz', 0, 'xyzEscaped'],
                ],
            );

        $element = 'a';

        $htmlElement = new HtmlElement($escapeHtml, $escapeHtmlAttr);

        self::assertSame(
            $expected,
            $htmlElement->toHtml(
                $element,
                ['id' => $id, 'title' => '', 'class' => $class, 'href' => $href, 'target' => $target, 'data-click' => $onclick, 'data-test' => $testData, 'xxx', 'open' => true, 'value' => $value, 'von' => 'xyz'],
                $escapedTranslatedLabel,
            ),
        );
    }
}
