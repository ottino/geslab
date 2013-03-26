<?php

/**
 * The main include file for PrintAnything class
 *
 * PHP version 4 and 5
 *
 * PrintAnything is a class that generates JavaScript, HTML and CSS code to add
 * links and form buttons which send any HTML markup to the printer. The class
 * supports multiple printing contexts for one screen page.
 *
 * PrintAnything PHP Class (c) 2008 Vagharshak Tozalakyan
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @version  0.1.1
 * @author   Vagharshak Tozalakyan <hide@address.com>
 * @license  http://www.opensource.org/licenses/mit-license.php
 */

class PrintAnything
{
    var $_context = 0;

    function _prepareString($str)
    {
        $str = str_replace("\r", '', $str);
        $str = str_replace("\n", '\n', $str);
        $str = str_replace("\047", "\\'", $str);
        $str = str_replace('"', '\"', $str);
        return $str;
    }

    function readBody($fname)
    {
        $html = '';
        ob_start();
        if (@readfile($fname)) {
            $html = ob_get_contents();
        }
        ob_end_clean();
        if (preg_match('#<body[^>]*>(.+?)</body>#is', $html, $matches)) {
            $html = $matches[1];
        }
        return $html;
    }

    function addPrintContext($printHtml, $stylesheet = array())
    {
        $this->_context += 1;
        $printHtml = $this->_prepareString($printHtml);
        echo '<!-- PRINTING CONTEXT ' . $this->_context . ' -->' . "\n";
        echo '<style type="text/css">' . "\n";
        echo '@media print {' . "\n";
        echo '    #PAScreenOut' . $this->_context . ' { display: none; }' . "\n";
        foreach ($stylesheet as $k => $v) {
            echo '    ' . $k . ' { ' . $v . '}' . "\n";
        }
        echo '}' . "\n";
        echo '@media screen {' . "\n";
        echo '    #PAPrintOut' . $this->_context . ' { display: none; }' . "\n";
        echo '}' . "\n";
        echo '</style>' . "\n";
        echo '<script type="text/javascript" language="JavaScript">' . "\n";
        echo 'function PA_GoPrint_' . $this->_context . '()' . "\n";
        echo '{' . "\n";
        echo '    document.body.innerHTML = \'<div id="PAScreenOut' . $this->_context . '">\' + document.body.innerHTML + \'<\/div>\';' . "\n";
        echo '    document.body.innerHTML += \'<div id="PAPrintOut' . $this->_context . '">' . $printHtml . '<\/div>\';' . "\n";
        echo '    window.print();' . "\n";
        echo '}' . "\n";
        echo '</script>' . "\n";
        echo '<!-- END OF PRINTING CONTEXT ' . $this->_context . ' -->' . "\n";
        return $this->_context;
    }

    function showPrintLink($context, $linkText, $attributes = '')
    {
        echo '<a href="javascript:PA_GoPrint_' . $context . '()"' . (!empty($attributes) ? ' ' . $attributes : '') . '>' . $linkText . '</a>';
    }

    function showPrintButton($context, $buttonText, $attributes = '')
    {
        echo '<input type="button" value="' . $buttonText . '"' . (!empty($attributes) ? ' ' . $attributes : '') . ' onclick="PA_GoPrint_' . $context . '()" />';
    }

}

?>