<?php
/**
 * @copyright Copyright (c) 2014 Carsten Brandt
 * @license https://github.com/cebe/markdown/blob/master/LICENSE
 * @link https://github.com/cebe/markdown#readme
 */

namespace cebe\markdown\latex;

use cebe\markdown\block\FencedCodeTrait;
use cebe\markdown\block\TableTrait;
use cebe\markdown\inline\StrikeoutTrait;
use cebe\markdown\inline\UrlLinkTrait;

/**
 * Markdown parser for github flavored markdown.
 *
 * - uses the [tabularx](http://www.ctan.org/pkg/tabularx) environment for tables.
 *
 * @author Carsten Brandt <mail@cebe.cc>
 */
class GithubMarkdown extends Markdown
{
	// include block element parsing using traits
	use TableTrait;
	use FencedCodeTrait;

	// include inline element parsing using traits
	use StrikeoutTrait;
	use UrlLinkTrait;

	/**
	 * @var boolean whether to interpret newlines as `<br />`-tags.
	 * This feature is useful for comments where newlines are often meant to be real new lines.
	 */
	public $enableNewlines = false;

	/**
	 * @inheritDoc
	 */
	protected $escapeCharacters = [
		// from Markdown
		'\\', // backslash
		'`', // backtick
		'*', // asterisk
		'_', // underscore
		'{', '}', // curly braces
		'[', ']', // square brackets
		'(', ')', // parentheses
		'#', // hash mark
		'+', // plus sign
		'-', // minus sign (hyphen)
		'.', // dot
		'!', // exclamation mark
		'<', '>',
		// added by GithubMarkdown
		':', // colon
		'|', // pipe
	];


	/**
	 * Consume lines for a paragraph
	 *
	 * Allow headlines, lists and code to break paragraphs
	 */
	protected function consumeParagraph($lines, $current)
	{
		// consume until newline
		$content = [];
		for ($i = $current, $count = count($lines); $i < $count; $i++) {
			$line = $lines[$i];
			if (!empty($line) && ltrim($line) !== '' &&
				!($line[0] === "\t" || $line[0] === " " && strncmp($line, '    ', 4) === 0) &&
				!$this->identifyHeadline($line, $lines, $i) &&
				!$this->identifyUl($line, $lines, $i) &&
				!$this->identifyOl($line, $lines, $i))
			{
				$content[] = $line;
			} else {
				break;
			}
		}
		$block = [
			'paragraph',
			'content' => $this->parseInline(implode("\n", $content)),
		];
		return [$block, --$i];
	}

	/**
	 * @inheritdoc
	 */
	protected function renderCode($block)
	{
		// make sure this is not replaced by the trait
		return parent::renderCode($block);
	}

	/**
	 * @inheritdoc
	 */
	protected function renderAutoUrl($block)
	{
		return '\url{' . $this->escapeUrl($block[1]) . '}';
	}

	/**
	 * @inheritdoc
	 */
	protected function renderStrike($block)
	{
		return '\sout{' . $this->renderAbsy($block[1]) . '}';
	}

	/**
	 * @inheritdocs
	 *
	 * Parses a newline indicated by two spaces on the end of a markdown line.
	 */
	protected function renderText($text)
	{
		if ($this->enableNewlines) {
			return preg_replace("/(  \n|\n)/", "\\\\\\\\\n", $this->escapeLatex($text[1]));
		} else {
			return parent::renderText($text);
		}
	}

	private $_tableCellHead = false;
	private $_tds = 0;

	protected function renderTable($block)
	{
		$align = [];
		foreach($block['cols'] as $col) {
			if (empty($col)) {
				$align[] = 'X';
			} else {
				$align[] = $col[0];
			}
		}
		$align = implode('|', $align);

		$content = '';
		$first = true;
		$numThs = 0;
		foreach($block['rows'] as $row) {
			$this->_tableCellHead = $first;
			$this->_tds = 0;
			$content .= $this->renderAbsy($this->parseInline($row)); // TODO move this to the consume step
			if ($first) {
				$numThs = $this->_tds;
			} else {
				while ($this->_tds < $numThs) {
					$content .= ' & ';
					$this->_tds++;
				}
			}
			$content .= "\\\\ \\hline\n";
			$first = false;
		}
		return "\n\\noindent\\begin{tabularx}{\\textwidth}{|$align|}\\hline\n$content\\end{tabularx}\n\n";
	}

	/**
	 * @marker |
	 */
	protected function parseTd($markdown)
	{
		if (isset($this->context[1]) && $this->context[1] === 'table') {
			$this->_tds++;
			return [['tableSep'], 1];
		}
		return [['text', $markdown[0]], 1];
	}

	protected function renderTableSep($block)
	{
		return '&';
	}
}
