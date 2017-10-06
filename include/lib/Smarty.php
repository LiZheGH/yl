<?php
require_once 'smarty/Smarty.class.php';

/**
 * View
 *
 * @package View
 */
class LibSmarty extends Smarty
{
    private static $instance;

    public function __construct($params = null) {
        parent::__construct();
    }

     /**
     * Singleton Pattern
     *
     * @return object
    */
    static public function getInstance($params = null)
    {
        if (self::$instance == NULL) {
            self::$instance = new self($params);
        }
        self::$instance->setCompileDir(BASE_DIR . 'datafile/templates_c/');
        return self::$instance;
    }

}
