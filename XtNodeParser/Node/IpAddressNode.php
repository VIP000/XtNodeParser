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

class IpAddressNode extends Node implements \XtNodeParser\Implement\Node
{

    public function __construct(&$mXmlFeed = null)
    {
        parent::__construct($mXmlFeed);
        $mXmlFeed = null;
    }

    public function __toString()
    {
        $mXmlAttr = $this->getAttributesAsArray();
        if ($mXmlAttr['type'] == 1)
        {
            $this->getUserIp();
        }
        else if ($mXmlAttr['type'] == 2)
        {
            return $_SERVER['REMOTE_ADDR'];
        }
        else
        {
            return \sprintf('xt:ipaddress: <b>type = %d</b> range not supported.', $mXmlAttr['type']);
        }
    }

    public function __destruct()
    {
        parent::__destruct();
    }

    private function getUserIp()
    {
        if (isset($_SERVER['HTTP_CLIENT_IP']))
        {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        elseif (isset($_SERVER['REMOTE_ADDR']))
        {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        else
        {
            $ip = 'XX';
        }
        return $ip;
    }

}