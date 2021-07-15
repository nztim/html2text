<?php

use NZTim\Html2Text\Html2Text;

require(__DIR__ . "/../src/Html2Text.php");

class Html2TextTest extends \PHPUnit\Framework\TestCase
{
    private function doTest($test, $options = [])
    {
        return $this->doTestWithResults($test, $test, $options);
    }

    private function doTestWithResults($test, $result, $options = [])
    {
        $this->assertTrue(file_exists(__DIR__ . "/$test.html"), "File '$test.html' did not exist");
        $this->assertTrue(file_exists(__DIR__ . "/$result.txt"), "File '$result.txt' did not exist");
        $input = file_get_contents(__DIR__ . "/$test.html");
        $expected = Html2Text::fixNewlines(file_get_contents(__DIR__ . "/$result.txt"));
        $output = Html2Text::convert($input, $options);
        if ($output != $expected) {
            file_put_contents(__DIR__ . "/$result.output", $output);
        }
        $this->assertEquals($output, $expected);
    }

    public function testBasic()
    {
        $this->doTest("basic");
    }

    public function testAnchors()
    {
        $this->doTest("anchors");
    }

    public function testMoreAnchors()
    {
        $this->doTest("more-anchors");
    }

    public function test3()
    {
        $this->doTest("test3");
    }

    public function test4()
    {
        $this->doTest("test4");
    }

    public function testTable()
    {
        $this->doTest("table");
    }

    public function testNbsp()
    {
        $this->doTest("nbsp");
    }

    public function testLists()
    {
        $this->doTest("lists");
    }

    public function testPre()
    {
        $this->doTest("pre");
    }

    public function testNewLines()
    {
        $this->doTest("newlines");
    }

    public function testNestedDivs()
    {
        $this->doTest("nested-divs");
    }

    public function testBlockQuotes()
    {
        $this->doTest("blockquotes");
    }

    public function testFullEmail()
    {
        $this->doTest("full_email");
    }

    public function testImages()
    {
        $this->doTest("images");
    }

    public function testNonBreakingSpaces()
    {
        $this->doTest("non-breaking-spaces");
    }

    public function testUtf8Example()
    {
        $this->doTest("utf8-example");
    }

    public function testWindows1252Example()
    {
        $this->doTest("windows-1252-example");
    }

    public function testMsoffice()
    {
        $this->doTest("msoffice");
    }

    public function testDOMProcessing()
    {
        $this->doTest("dom-processing");
    }

    public function testEmpty()
    {
        $this->doTest("empty");
    }

    public function testHugeMsoffice()
    {
        $this->doTest("huge-msoffice");
    }

    public function testZeroWidthNonJoiners()
    {
        $this->doTest("zero-width-non-joiners");
    }

    public function testInvalidXML()
    {
        $this->expectWarning();
        $this->doTest("invalid", ['ignore_errors' => false]);
    }

    public function testInvalidXMLIgnore()
    {
        $this->doTest("invalid", ['ignore_errors' => true]);
    }

    public function testInvalidOption()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->doTest("basic", ['invalid_option' => true]);
    }

    public function testBasicDropLinks()
    {
        $this->doTestWithResults("basic", "basic.no-links", ['drop_links' => true]);
    }

    public function testAnchorsDropLinks()
    {
        $this->doTestWithResults("anchors", "anchors.no-links", ['drop_links' => true]);
    }
}