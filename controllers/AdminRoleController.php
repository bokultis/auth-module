<?php

/**
 * Admin Role controller
 *
 * @package Auth
 * @subpackage Controllers
 * @copyright Horisen
 * @author marko
 */
class Auth_AdminRoleController extends HCMS_Controller_Action_Admin {

    /**
     *
     * @var HCMS_Controller_Action_Helper_AjaxForm
     */
    protected $_formHelper = null;
    
    protected $_authPrivilege = 'master';

    public function init(){
        parent::init();
        $this->_formHelper = $this->getHelper('ajaxForm');
    }

    /**
     * List users
     */
    public function roleAction() {
    }

    /**
     * Ajax listing of users
     */
    public function roleListAction() {
        //criteria
        $criteria = array();
        
        if(null != $this->_getParam('searchFilter')){
            $criteria['search_filter'] = $this->_getParam('searchFilter');
        }
        
        if (null != $this->_getParam('name')) {
            $criteria['name'] = $this->_getParam('name');
        }
        //order
        $order = $this->_request->getParam('order');
        if (isset($order)) {
            $order = array($order);
        } else {
            $order = array("name ASC");
        }
        //paging
        $page = $this->_request->getParam('page');
        $perPage = $this->_request->getParam('perPage');
        if(!isset ($page) || $page < 1){
            $page = 1;
        }
        if(!isset ($perPage) || $perPage < 1 || $perPage > 300){
            $perPage = 10;
        }
        $paging = array(
            'page'      => $page,
            'perPage'   => $perPage
        );
        $records = Auth_Model_RoleMapper::getInstance()->fetchAll($criteria, $order, $paging);
        $data = array(
            'total' => $paging['total'],
            'page' => $paging['page'],
            'records' => $paging['records'],
            'perPage' => $paging['perPage'],
            'rows' => array()
        );

        /* @var $record Auth_Model_Roles */
        foreach ($records as $record) {
            $data['rows'][] = array(
                'id' => $record->get_id(),
                'name' => $record->get_name(),
                'parent_id' => $record->get_parent_id()
            );
        }

        $this->_helper->json->sendJson($data);
    }

    public function roleEditAction(){
        $data = $this->getRequest()->getPost('data');
        $id = $this->_getParam('id');

        //check if cancel button is pressed
        if($this->_formHelper->isCancel()) {
            //cancel form
            return $this->_formHelper->returnCancel($this->view->url(array('action' => 'role')), $this->translate('Action canceled'));
        }        

        //create form object
        $form = new Auth_Form_Role($data);

        //postback - save?
        if ($this->_formHelper->isSave()) {            
            //check if valid
            if($form->isValid()) {                
                $values = $form->getValues();
                //create entity object from submitted values, and save
                $role = new Auth_Model_Role($values);                
                Auth_Model_RoleMapper::getInstance()->save($role);                
                //save done, return success
                return $this->_formHelper->returnSuccess($this->view->url(array('action' => 'role')), $this->translate('Role saved.'));
            }
            else {
                //we have errors - return json or continue
                $this->_formHelper->returnError($form->getMessages());
            }
        }
        //first run of the form - grab data from mapper
        elseif(!$this->_formHelper->getRequest()->isPost()) {
            //edit action
            if(isset ($id) && $id > 0) {
                $role = new Auth_Model_Role();
                if(!Auth_Model_RoleMapper::getInstance()->find($id, $role)){
                    throw new Exception("Role not found");
                }
                //fetch data
                $data = $role->toArray();
                //populate form with data
                $form->setData($data);
            }
        }
        $criteria = array();
        $roles = Auth_Model_RoleMapper::getInstance()->fetchAll($criteria);
        $this->view->roles = $roles;
        $this->view->data = $data;
    }
}