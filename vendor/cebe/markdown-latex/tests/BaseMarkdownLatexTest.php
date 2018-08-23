<?php
/**
 * @copyright Copyright (c) 2014 Carsten Brandt
 * @license https://github.com/cebe/markdown/blob/master/LICENSE
 * @link https://github.com/cebe/markdown#readme
 */

namespace cebe\markdown\latex\tests;
use cebe\markdown\tests\BaseMarkdownTest;

/**
 * Base class for all Test cases.
 *
 * @author Carsten Brandt <mail@cebe.cc>
 */
abstract class BaseMarkdownLatexTest extends BaseMarkdownTest
{
	protected $outputFileExtension = '.tex';

	public function testUtf8()
	{
		$this->assertSame("абвгдеёжзийклмнопрстуфхцчшщъыьэюя\n\n", $this->createMarkdown()->parse('абвгдеёжзийклмнопрстуфхцчшщъыьэюя'));
		$this->assertSame("there is a charater, 配\n\n", $this->createMarkdown()->parse('there is a charater, 配'));
		$this->assertSame("Arabic Latter ``م (M)''\n\n", $this->createMarkdown()->parse('Arabic Latter "م (M)"'));
		$this->assertSame("電腦\n\n", $this->createMarkdown()->parse('電腦'));

		$this->assertSame('абвгдеёжзийклмнопрстуфхцчшщъыьэюя', $this->createMarkdown()->parseParagraph('абвгдеёжзийклмнопрстуфхцчшщъыьэюя'));
		$this->assertSame('there is a charater, 配', $this->createMarkdown()->parseParagraph('there is a charater, 配'));
		$this->assertSame("Arabic Latter ``م (M)''", $this->createMarkdown()->parseParagraph('Arabic Latter "م (M)"'));
		$this->assertSame('電腦', $this->createMarkdown()->parseParagraph('電腦'));
	}

	public function testInvalidUtf8()
	{
//   		$m = $this->createMarkdown();
//   		$this->assertEquals('\\lstinline|�|', $m->parseParagraph("`\x80`"));
	}

	/**
	 * @dataProvider pregData
	 */
	public function testPregReplaceR($input, $exptected, $pexpect = null)
	{
		$this->markTestSkipped();
	}
}
