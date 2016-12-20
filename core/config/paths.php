<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if (!defined('APP')) {
	define('APP', ROOT.DS.APP_DIR.DS);
}
/**
 * Path to the application's models directory.
 */
    define('MODELS', APP.'models');

/**
 * Path to the application's models directory.
 */
    define('CACHES', APP.'cache');
/**
 * Path to the application's dao directory.
 */
    define('DAOS', APP.'dao');

/**
 * Path to the application's libs directory.
 */
    define('LIBS', APP.'libs');
        
/**
 * Path to the application's tpl directory.
 */
    define('_tpl_path', APP . DS .'tpl');

/**
 * Path to the application's _page_path directory.
 */
    define('_page_path', APP . DS .'controllers');

/**
 * Path to the application's _element_tpl_path directory.
 */
    define('_element_tpl_path', APP . DS .'tpl'.DS.'element');

?>
