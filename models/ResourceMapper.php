<?php
/**
 * Resource Mapper
 *
 * @package Auth
 * @subpackage Models
 * @copyright Horisen
 * @author marko
 */
class Auth_Model_ResourceMapper extends HCMS_Model_Mapper {
    /**
     * singleton instance
     *
     * @var Auth_Model_ResourceMapper
     */
    protected static $_instance = null;

    /**
     *
     * @var Auth_Model_DbTable_Resource
     */
    protected $_dbTable;


    /**
     * private constructor
     */
    private function  __construct()
    {
        $this->_dbTable = new Auth_Model_DbTable_Resource();
        $this->_initLogger();
    }

    /**
     * get instance
     *
     *
     * @return Auth_Model_ResourceMapper
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
     * @param Auth_Model_Resource $resource
     * @return boolean
     */
    public function find($id, Auth_Model_Resource $resource) {
        
        /* @var $select Zend_Db_Select*/
        $select = $this->_dbTable->select();
        $select ->where("id = ?", $id);
        $resultSet = $this->_dbTable->fetchAll($select);
        if (0 == count($resultSet)) {
            return false;
        }
        $row = $resultSet->current();
        $rowArray = $row->toArray();
        $resource->setOptions($rowArray);
        return true;
    }

    /**
     * Find and populate entity by code
     *
     * @param string $code
     * @param Auth_Model_Resource $resource
     * @return boolean
     */
    public function findByCode($code, Auth_Model_Resource $resource) {

        /* @var $select Zend_Db_Select*/
        $select = $this->_dbTable->select();
        $select ->where("code = ?", $code);
        $resultSet = $this->_dbTable->fetchAll($select);
        if (0 == count($resultSet)) {
            return false;
        }
        $row = $resultSet->current();
        $resource->setOptions($row->toArray());
        return true;
    }


    /**
     * Find all resources
     * 
     * @param array $criteria
     * @param array $orderBy
     * @param array $paging
     * @return array 
     */
    public function fetchAll($criteria = array(), $orderBy = array(), &$paging = null) {
        /* @var $select Zend_Db_Select*/
        $select = $this->_dbTable->select();
        $select->setIntegrityCheck(false)
                ->from(array('r'=>'auth_resource'),array('r.*'));
   
        if(isset ($criteria['search_filter'])){
            $searchString =  '%' . $criteria['search_filter'] . '%';            
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

        $resources = array();
        if (0 == count($resultSet)) {
            return $resources;
        }

        foreach ($resultSet as $row) {
            $resources[$row->id] = new Auth_Model_Resource($row->toArray());
        }

        return $resources;
    }

    /**
     * Save entity
     *
     * @param Auth_Model_Resource $resource
     */
    public function save(Auth_Model_Resource $resource) {
        $data = array();
      
        $data = $resource->toArray();

        $id = $resource->get_id();
        if (!isset ($id) || $id <= 0) {
            unset($data['id']);
            $id = $this->_dbTable->insert($data);
            $resource->set_id($id);
        } else {
            $this->_dbTable->update($data, array('id = ?' => $id));
        }        
    }
}