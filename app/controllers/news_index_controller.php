<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class page_news_index extends page
{




    /**
     * @desc 首页
     */
    public function  action_index()
    {
        
        $this->tpl("news_index_index.php");
    }


}
