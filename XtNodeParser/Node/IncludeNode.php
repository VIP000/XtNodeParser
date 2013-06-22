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
 *
 * @package    XtNodeParser
 * @author     Shushant Kumar
 * @link http://github.com/punkboy/XtNodeParser
 */

namespace XtNodeParser\Node;

class IncludeNode extends Node implements \XtNodeParser\Implement\Node
{

    public function __construct(&$mXmlFeed = null)
    {
        parent::__construct($mXmlFeed);
        $mXmlFeed = null;
    }

    public function __toString()
    {
        $mXmlAttr = $this->getAttributesAsArray();

        $content = sprintf('xt:include [<b>%s</b>] failed to open stream: No such file or directory found.', $mXmlAttr['file']);
        if (isset($mXmlAttr['file']) && file_exists($mXmlAttr['file']))
        {
            $content = file_get_content($mXmlAttr['file']);
        }
        else if (isset($mXmlAttr['dafault']) && file_exists($mXmlAttr['dafault']))
        {
            $content = file_get_contents($mXmlAttr['deafult']);
        }
        return $content;
    }

    public function __destruct()
    {
        parent::__destruct();
    }

}