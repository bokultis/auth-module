<?php
/**
 * User Entity class
 *
 * @package Auth
 * @subpackage Models
 * @copyright Horisen
 * @author marko
 */
class Auth_Model_User extends HCMS_Model_Entity
{
    protected $_camelCase = false;
    
    protected $_id;
    protected $_role_id;
    protected $_username;
    protected $_password;
    protected $_new_password;
    protected $_first_name;
    protected $_last_name;
    protected $_email;
    protected $_status;
    protected $_lang;
    protected $_image_path;
    protected $_data;
    protected $_created;
    protected $_logged;

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

    public function get_username() {
        return $this->_username;
    }

    public function set_username($_username) {
        $this->_username = $_username;
        return $this;
    }

    public function get_password() {
        return $this->_password;
    }

    public function set_password($_password) {
        $this->_password = $_password;
        return $this;
    }
    public function get_new_password() {
        return $this->_new_password;
    }

    public function set_new_password($_new_password) {
        $this->_new_password = $_new_password;
        return $this;
    }

    public function get_first_name() {
        return $this->_first_name;
    }

    public function set_first_name($_first_name) {
        $this->_first_name = $_first_name;
        return $this;
    }

    public function get_last_name() {
        return $this->_last_name;
    }

    public function set_last_name($_last_name) {
        $this->_last_name = $_last_name;
        return $this;
    }

    public function get_email() {
        return $this->_email;
    }

    public function set_email($_email) {
        $this->_email = $_email;
        return $this;
    }

    public function get_status() {
        return $this->_status;
    }

    public function set_status($_status) {
        $this->_status = $_status;
        return $this;
    }

    public function get_lang() {
        return $this->_lang;
    }

    public function set_lang($_lang) {
        $this->_lang = $_lang;
        return $this;
    }

    public function get_image_path() {
        return $this->_image_path;
    }

    public function set_image_path($_image_path) {
        $this->_image_path = $_image_path;
        return $this;
    }

    public function get_data($key = null) {
        if(!isset ($key)){
            return $this->_data;
        }
        else{
            if(isset ($this->_data[$key])){
                return $this->_data[$key];
            }
            else{
                return null;
            }
        }
    }

    public function set_data($_data) {
        $this->_data = $_data;
        return $this;
    }

    public function get_created() {
        return $this->_created;
    }

    public function set_created($_created) {
        $this->_created = $_created;
        return $this;
    }

    public function get_logged() {
        return $this->_logged;
    }

    public function set_logged($_logged) {
        $this->_logged = $_logged;
        return $this;
    }

}