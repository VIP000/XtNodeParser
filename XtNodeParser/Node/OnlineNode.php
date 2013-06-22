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

class OnlineNode extends Node implements \XtNodeParser\Implement\Node
{

    public function __construct(&$mXmlFeed = null)
    {
        parent::__construct($mXmlFeed);
        $mXmlFeed = null;
    }

    public function __toString()
    {
        $mXmlAttr = $this->getAttributesAsArray();
        // rest of ur code to implement online user counter

    }

    public function __destruct()
    {
        parent::__destruct();
    }

}