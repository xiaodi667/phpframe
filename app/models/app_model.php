<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of app_model
 *
 * @author jtg
 */
class app_model extends model {
     /**
     * 供检验值的规则与返回信息
     */
    public $verifier = null;

    /**
     * 增加的自定义验证函数
     */
    public $addrules = array();
    /**
     * 表主键
     */
    public $pk;
    /**
     * 表名称
     */
    public $table;

    /**
     * 关联描述
     */
    public $linker = null;

    /**
     * 表全名
     */
    public $tbl_name = null;

    /**
     * 数据驱动程序
     */
    public $_db;
    
    public $_dbname;

    /**
     * 构造函数
     */
    function  __construct() {
        $this->_db = $this->getPdo($this->_dbname);
    }

    //数据库连接�
    private function getPdo($name)
    {
        $tmpKey = (WP_ENV == 'local') ? 'remote' : 'remote_'.WP_ENV;
		$config_db = app_config::load($tmpKey);
        if(isset($config_db[$name]))
        {

            $dbconfig=$config_db[$name];
        }else{
            $name='BASIC_MASTER_NAME';
            $dbconfig = $config_db[$name];
        }

        $DB = new PDO($dbconfig['driver'] . ':host=' . $dbconfig['host'] . ';dbname=' . $dbconfig['database'], $dbconfig['login'], $dbconfig['password'], array(PDO::ATTR_PERSISTENT => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $DB->exec('set names utf8');
        $DB->exec(" USE  `" . $dbconfig['database'] . "`");
        //$this->_db = $DB;
        return $DB;
    }
    public function add($option=array())
    {
        $sql = " INSERT into {$this->table} ";
        $fields = implode(',', array_keys($option));
        $values = array();
        foreach ($option as $k => $v)
        {
            $values[] = ':' . $k;
        }
        $sql.='(' . $fields . ') values(' . implode(',', $values) . ')';
        echo $sql;
        $this->_db->prepare($sql)->execute($option);
        return $this->_db->lastInsertId();
    }

    public function update($id,$option=array())
    {
        $sql = " update {$this->table} set ";
        $param = $option;
        $tmp2 = implode(',',array_keys($param));
        $tmp3 = array();
        foreach ($param as $k=>$v)
        {
                $tmp3[]=':'.$k;
                $sql.= $k.'=:'.$k.',';
        }
        $sql = substr($sql,0,-1);
        $sql.=" where id ='".$id."'";

        $db->prepare($sql)->execute($param);
    }

    /**
     * 按条件删除记录
     *
     * @param conditions 数组形式，查找条件，此参数的格式用法与find/findAll的查找条件参数是相同的。
     */
    public function delete($conditions)
    {
            $where = "";
            if(is_array($conditions))
            {
                $join = array();
                foreach( $conditions as $key => $condition )
                {
                        //$condition = $this->escape($condition);
                        $join[] = "{$key} = {$condition}";
                }
                $where = "WHERE ( ".join(" AND ",$join). ")";
            }
            else
            {
                if(null != $conditions)$where = "WHERE ( ".$conditions. ")";
            }
            $sql = "DELETE FROM {$this->tbl_name} {$where}";
            return $this->_db->exec($sql);
    }
}
?>
