<?php

class Autoloader
{

    /**
     * Registers Autoloader as an SPL autoloader.
     */
    public static function register()
    {
        ini_set('unserialize_callback_func', 'spl_autoload_call');
        spl_autoload_register(array(new self, 'autoload'));
    }

    /**
     * Handles autoloading of classes.
     *
     * @param string $class A class name.
     */
    public static function autoload($class)
    {
        if (!class_exists($class))
        {
            if (false !== strpos($class, "XtNodeParser"))
            {
                $_class_name_path = str_replace(array('_', "\0", "\\"), array('/', '', '/'), $class);

                require __DIR__ . '/' . $_class_name_path . '.php';
            }
        }
    }
    

}
