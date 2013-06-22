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
 * This helper Class is responsible for conveting tagname to Class name
 * @package    XtNodeParser
 * @author     Shushant Kumar
 * @link http://github.com/punkboy/XtNodeParser
 * @example <tx:some_tagname /> will be converted into SomeTagname (into Class)
 */

namespace XtNodeParser;

class NodeList
{

    private $mNodeName, $mXmlFeed;

    public function __construct(&$mNodeName, &$mXmlFeed)
    {
        $this->mNodeName = $mNodeName;
        $this->mXmlFeed = $mXmlFeed;
    }

    public function compile()
    {

        $mClassFileName = $this->getClassFileName($this->mNodeName);
        if (false !== $mClassFileName)
        {
            $mClassName = '\\XtNodeParser\\Node\\' . $mClassFileName;
            try
            {
                $mNodeInstance = new $mClassName($this->mXmlFeed);
                return $mNodeInstance;
            }
            catch (\Exception $e)
            {
                $mNodeInstance = null;
                throw new Error\Runtime($e->getMessage());
            }
        }
        return \sprintf('xt:%s is not yet supported.', $this->mNodeName);
    }

    protected function getClassFileName(&$mClassName)
    {
        try
        {
            $mDirIterator = new \DirectoryIterator(__DIR__ . '/Node/');
            foreach ($mDirIterator as $mClassFile)
            {
                if (strtolower($mClassName . 'node.php') == strtolower($mClassFile->getFilename()))
                {
                    return str_replace('.php', '', $mClassFile->getFilename());
                }
            }
        }
        catch (\Exception $e)
        {
            $mDirIterator = null;
            throw new Error\Runtime($e->getMessage());
        }
        return false;
    }

    public function __destruct()
    {
        $this->mNodeName = null;
        $this->mXmlFeed = null;
    }

}