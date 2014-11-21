<?php
/**
 * Auth Resource Entity class
 *
 * @package Auth
 * @subpackage Models
 * @copyright Horisen
 * @author marko
 */
class Auth_Model_Resource extends HCMS_Model_Entity
{
    protected $_camelCase = false;
    
    protected $_id;    
    protected $_name;
    protected $_parent_id;
    protected $_code;
    protected $_module;
  
    public function get_id() {
        return $this->_id;
    }

    public function set_id($_id) {
        $this->_id = $_id;
        return $this;
    }

    public function get_name() {
        return $this->_name;
    }

    public function set_name($_name) {
        $this->_name = $_name;
        return $this;
    }

    public function get_parent_id() {
        return $this->_parent_id;
    }

    public function set_parent_id($_parent_id) {
        $this->_parent_id = $_parent_id;
        return $this;
    }

    public function get_code() {
        return $this->_code;
    }

    public function set_code($_code) {
        $this->_code = $_code;
        return $this;
    }

    public function get_module() {
        return $this->_module;
    }

    public function set_module($_module) {
        $this->_module = $_module;
        return $this;
    }



   
}