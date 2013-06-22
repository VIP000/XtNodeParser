<?php

/*
 * This file is part of XtNodeParser
 *
 * (c) 2013 Shushant Kumar
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * This is Core of XtNodeParser it split all tagname which start with namespace <b>xt</b> and replace the current XML feed into its desire result
 * @package    XtNodeParser
 * @author     Shushant Kumar
 * @link http://github.com/punkboy/XtNodeParser
 * @example <tx:some_tagname /> will be converted into SomeTagname (into Class)
 */

namespace XtNodeParser;

class Parser
{

    /**
     *
     * @var type String
     */
    private $_context;

    const XT_NODE_SELF_CLOSE_PATTERN = '|<xt:(\w+)\s?(.+?)\s*/>|ui';
    const XT_NODE_FULL_CLOSE_PATTERN = '|<xt:(\w+)\s(.+?)\s*>(?<Text>(.*?))<\s*/xt:\w+\s*>|ui';

    /**
     * 
     * @param type $_context 
     */
    public function __construct($_context)
    {
        $this->_context = &$_context;
        $this->parseXmlFeed();
    }

    private function parseXmlFeed()
    {
        if (false !== strpos($this->_context, '<xt:'))
        {
            $matches = [];
            if (preg_match_all(
                            static::XT_NODE_SELF_CLOSE_PATTERN, $this->_context, $matches
                    ) > 0)
            {
                $mReplaceWith = array();

                foreach ($matches[1] as $mIndex => $mValue)
                {
                    $mNodeList = new NodeList($mValue, $matches[0][$mIndex]);
                    $mReplaceWith[$matches[0][$mIndex]] = (string) $mNodeList->compile();
                    $mNodeList = null;
                    $mXmlFeed = null;
                }
                $this->_context = str_replace(array_keys($mReplaceWith), array_values($mReplaceWith), $this->_context);
            }
            $matches = null;
        }
    }

    public function __destruct()
    {
        $this->_context = null;
    }

    public function __toString()
    {
        return $this->_context;
    }

}