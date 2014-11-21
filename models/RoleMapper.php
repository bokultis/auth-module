<?php
/**
 * Role Mapper
 *
 * @package Auth
 * @subpackage Models
 * @copyright Horisen
 * @author marko
 */
class Auth_Model_RoleMapper extends HCMS_Model_Mapper {
    /**
     * singleton instance
     *
     * @var Auth_Model_RoleMapper
     */
    protected static $_instance = null;

    /**
     *
     * @var Auth_Model_DbTable_Role
     */
    protected $_dbTable;


    /**
     * private constructor
     */
    private function  __construct()
    {
        $this->_dbTable = new Auth_Model_DbTable_Role();
        $this->_initLogger();
    }

    /**
     * get instance
     *
     *
     * @return Auth_Model_RoleMapper
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
     * Find and populate entity by id
     *
     * @param string $id
     * @param Auth_Model_Role $role
     * @return boolean
     */
    public function find($id, Auth_Model_Role $role) {
        
        /* @var $select Zend_Db_Select*/
        $select = $this->_dbTable->select();
        $select ->where("id = ?", $id);
        $resultSet = $this->_dbTable->fetchAll($select);
        if (0 == count($resultSet)) {
            return false;
        }
        $row = $resultSet->current();
        $rowArray = $row->toArray();
        $role->setOptions($rowArray);
        return true;
    }


    /**
     * Find all users
     * @param array $criteria
     * @param array $orderBy
     * @param array $paging
     * @return array 
     */
    public function fetchAll($criteria = array(), $orderBy = array(), &$paging = null) {
        /* @var $select Zend_Db_Select*/
        $select = $this->_dbTable->select();
        $select->setIntegrityCheck(false)
                ->from(array('r'=>'auth_role'),array('r.*'));
   
        if(isset ($criteria['search_filter'])){
            $searchString =  '%' . $criteria['search_filter'] . '%';            
            $select->where(' r.name LIKE ? ',$searchString);
        }
        
        if(isset ($criteria['name'])){
            $searchString =  '%' . $criteria['name'] . '%';            
            $select->where(' r.name LIKE ? ',$searchString);
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

        $roles = array();
        if (0 == count($resultSet)) {
            return $roles;
        }

        foreach ($resultSet as $row) {
            $rowArray = $row->toArray();
            $role = new Auth_Model_Role($rowArray);
            $roles[] = $role;
        }

        return $roles;
    }

    /**
     * Save entity
     *
     * @param Auth_Model_Role $role
     */
    public function save(Auth_Model_Role $role) {
        $data = array();
      
        $data = $role->toArray();
//        $this->_populateDataArr($data, $user, array('id','code','title',
//            'content','application_id'));

        $id = $role->get_id();
        if (!isset ($id) || $id <= 0) {
            unset($data['id']);
            $id = $this->_dbTable->insert($data);
            $role->set_id($id);
        } else {
            $this->_dbTable->update($data, array('id = ?' => $id));
        }        
    }
}