<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of basePage
 *
 * @author jtg
 */
class page 
{
    
   
    var $tpl_data = array();
    function run()
    {
        $action = 'index';
        if(isset($_GET['action']))
        {
            $action = $_GET['action'];
        }
        $m = 'action_'.$action;
        if(method_exists($this, $m))
        {
            $this->init();
            $this->$m();
        }
        else
        {
            header('location:/404.php');
            exit();
        }
    }
    function init()
    {

    }
    function action_index()
    {

    }
    function tpl($tpl)
    {
        $tpl = substr(trim($tpl), 5);
        $tpl = str_replace('_','/',$tpl);
        
        $file=_tpl_path.'/'.$tpl;
        if(file_exists($file))
        {
            extract($this->tpl_data);
            include($file);
        }
        else
        {
            echo " tpl file :$file not exists ";
        }

    }
    function renderElement($tpl)
    {
        $file = _element_tpl_path.'/'.$tpl;
        if(file_exists($file))
        {
            extract($this->tpl_data);
            include($file);
        }
        else
        {
            echo " tpl file :$file not exists ";
        }
    }
    function flash($message,$url,$pause=3)
    {
        $this->set('url', $url);
        $this->set('message', $message);
        $this->set('pause', $pause);
        $this->set('page_title', $message);
        
        $file = _element_tpl_path.'/flash.php';
        if(file_exists($file))
        {
            extract($this->tpl_data);
            include($file);
        }
        else
        {
            echo " tpl file :$file not exists ";
        }
        //$this->renderElement("flash.php");
    }
    function set($k,$v)
    {
        $this->tpl_data[$k]=$v;
    }

    function redirect($url)
    {
        header('Location: ' . $url);
    }
    
    
}
inject_check::filter();