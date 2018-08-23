Yii Framework 2 apidoc extension Change Log
===========================================

2.1.0 November 22, 2016
-----------------------

- Enh #8: Updated PHP Parser dependency to from version 0.9 to 1.0 to resolve dependency conflicts with other libraries. This breaks the implementation of the `yii\apidoc\helpers\PrettyPrinter` class (cebe)


2.0.6 November 22, 2016
-----------------------

- Bug #5: Enable display of deprecated information for methods, properties, constants and events (cebe)
- Bug #12: Do not publish PHP files for `jssearch.js` asset (cebe)
- Bug #42: Fixed stopword filter in JS search index, which resulted in empty results for some words like `sort` (cebe)
- Bug #61: Fixed duplicate description when `@inheritdoc` is used for properties (cebe)
- Bug #62: Make `@inheritdoc` tag more robust (cebe, sasha-ch)
- Bug #65: Fixed handling of `YiiRequirementChecker` namespace and navigation (cebe)
- Bug #67: Use multibyte compatible function for `ucfirst()` in descriptions (cebe, samdark)
- Bug #68: Fixed crash on empty type in PHPdoc (cebe, itnelo)
- Bug #76: Fixed broken links with external urls (CedricYii)
- Bug #79: Fixed crash due to missing encoding specified in `mb_*` functions (cebe, dingzhihao)
- Enh #29: Added styling for bootstrap tables (cebe)
- Enh #117: Add support for `int` and `bool` types (rob006)
- Enh #118: Separate warnings and errors occurred on processing files (rob006)
- Enh: Moved the title page of the PDF template into a separate file for better customization (cebe)


2.0.5 March 17, 2016
--------------------

- Bug #25: Fixed encoding of HTML tags in method definition for params passed by reference (cebe)
- Bug #37: Fixed error when extending Interfaces that are not in the current code base (cebe)
- Bug #10470: Fixed TOC links for headlines which include links (cebe)
- Enh #13: Allow templates to be specified by class name (tom--)
- Enh #13: Added a JSON template to output the class structure as a JSON file (tom--)
- Enh: Added callback `afterMarkdownProcess()` to HTML Guide renderer (cebe)
- Enh: Added `getHeadings()` method to ApiMarkdown class (cebe)
- Enh: Added css class to Info, Warning, Note and Tip blocks (cebe)
- Chg #31: Hightlight.php library is now used for code highlighing, the builtin ApiMarkdown::hightligh() function is not used anymore (cebe)


2.0.4 May 10, 2015
------------------

- Bug #3: Interface documentation did not show inheritance (cebe)
- Enh: Added ability to set pageTitle from command line (unclead)


2.0.3 March 01, 2015
--------------------

- no changes in this release.


2.0.2 January 11, 2015
----------------------

- no changes in this release.


2.0.1 December 07, 2014
-----------------------

- Bug #5623: Fixed crash when a class contains a setter that has no arguments e.g. `setXyz()` (cebe)
- Bug #5899: Incorrect class listed as `definedBy` reference for properties (cebe)
- Bug: Guide and API renderer now work with relative paths/URLs (cebe)
- Enh: Guide generator now skips `images` directory if it does not exist instead of throwing an error (cebe)
- Enh: Made `--guidePrefix` option available as a command line option (cebe)


2.0.0 October 12, 2014
----------------------

- Chg: Updated cebe/markdown to 1.0.0 which includes breaking changes in its internal API (cebe)

2.0.0-rc September 27, 2014
---------------------------

- no changes in this release.


2.0.0-beta April 13, 2014
-------------------------

- Initial release.
