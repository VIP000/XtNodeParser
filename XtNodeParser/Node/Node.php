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
 * This is Core of NodeParser and Responsible for parsing xml feed
 * @package    XtNodeParser
 * @author     Shushant Kumar
 * @link http://github.com/punkboy/XtNodeParser
 */

namespace XtNodeParser\Node;

class Node
{

    protected $sXmlParser;

    public function __construct(&$mXmlFeed = null)
    {
        try
        {
            $this->sXmlParser =
                    new \SimpleXMLElement(str_replace('xt:', 'xt_', $mXmlFeed));
            $mXmlFeed = null;
        }
        catch (\Exception $e)
        {
            throw new \XtNodeParser\Error\Runtime($e->getMessage());
        }
    }

    public function getsXmlParser()
    {
        return $this->sXmlParser;
    }

    public function getAttributesAsArray()
    {
        return json_decode(json_encode($this->sXmlParser), true)['@attributes'];
    }

    public function __destruct()
    {
        $this->sXmlParser = null;
    }

}