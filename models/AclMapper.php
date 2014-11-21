<?php
/**
 * Acl Mapper
 *
 * @package Auth
 * @subpackage Models
 * @copyright Horisen
 * @author marko
 */
class Auth_Model_AclMapper extends HCMS_Model_Mapper {
    /**
     * singleton instance
     *
     * @var Auth_Model_AclMapper
     */
    protected static $_instance = null;

    /**
     *
     * @var Auth_Model_DbTable_Acl
     */
    protected $_dbTable;


    /**
     * private constructor
     */
    private function  __construct()
    {
        $this->_dbTable = new Auth_Model_DbTable_Acl();
        $this->_initLogger();
    }

    /**
     * get instance
     *
     *
     * @return Auth_Model_AclMapper
     */
    public static function getInstance()
    {
        if(self::$_instance === null)
        {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    


    /**
     * Find all acl
     * 
     * @param array $criteria
     * @param array $orderBy
     * @param array $paging
     * @return array 
     */
    public function fetchAll($criteria = array(), $orderBy = array(), &$paging = null) {
        /* @var $select Zend_Db_Select*/
        $select = $this->_dbTable->select();
        $select ->setIntegrityCheck(false)
                ->from(array('a'=>'auth_acl'),array('a.*'))
                ->joinLeft(array('p'=>'auth_privilege'), 'p.id = a.privilege_id', array('privilege_code'=>'p.code'))
                ->joinLeft(array('r'=>'auth_resource'), 'p.resource_id = r.id', array('resource_code'=>'r.code'));
   
        if(isset ($criteria['role_id'])){
            $select->where('a.role_id = ? ',$criteria['role_id']);
        }

        if(is_array($orderBy) && count($orderBy) > 0 ){
            $select->order($orderBy);
        }
        //echo $select->__toString();die();
        // init paginator
        if($paging != null){
            $resultSet = $this->_getPagingRows($paging, $select);
        }
        else{
            $resultSet = $this->_dbTable->fetchAll($select);
        }

        $acls = array();
        if (0 == count($resultSet)) {
            return $acls;
        }

        foreach ($resultSet as $row) {
            $acls[] = new Auth_Model_Acl($row->toArray());
        }

        return $acls;
    }

}