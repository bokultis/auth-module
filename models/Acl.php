<?php
/**
 * Auth Acl Entity class
 *
 * @package Auth
 * @subpackage Models
 * @copyright Horisen
 * @author marko
 */
class Auth_Model_Acl extends HCMS_Model_Entity
{
    protected $_camelCase = false;

    protected $_id;
    protected $_role_id;
    protected $_privilege_id;
    protected $_allowed;

    protected $_resource_code;
    protected $_privilege_code;

    public function get_id() {
        return $this->_id;
    }

    public function set_id($_id) {
        $this->_id = $_id;
        return $this;
    }

    public function get_role_id() {
        return $this->_role_id;
    }

    public function set_role_id($_role_id) {
        $this->_role_id = $_role_id;
        return $this;
    }

    public function get_privilege_id() {
        return $this->_privilege_id;
    }

    public function set_privilege_id($_privilege_id) {
        $this->_privilege_id = $_privilege_id;
        return $this;
    }

    public function get_allowed() {
        return $this->_allowed;
    }

    public function set_allowed($_allowed) {
        $this->_allowed = $_allowed;
        return $this;
    }

    public function get_resource_code() {
        return $this->_resource_code;
    }

    public function set_resource_code($_resource_code) {
        $this->_resource_code = $_resource_code;
        return $this;
    }

    public function get_privilege_code() {
        return $this->_privilege_code;
    }

    public function set_privilege_code($_privilege_code) {
        $this->_privilege_code = $_privilege_code;
        return $this;
    }
}