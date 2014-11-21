<?php
/**
 * User add/edit form
 *
 * @package Modules
 * @subpackage Auth
 * @copyright Horisen
 * @author marko
 */
class Auth_Form_User extends HCMS_Form_Simple
{
    /**
     * Constructor
     *
     * @param array $data
     * @param array $options
     */
    public function __construct(array $data = null, array $options = null) {
        $filterRules = array();
        $validatorRules = array(
            'id'  => array(
                'allowEmpty'    => true
            ),
            'role_id'  => array(
                'presence'      => 'required',
                'allowEmpty'    => false,
                'messages'      => array(
                    0 => 'Please specify role.'
                )
            ),
            'username'  => array(
                'presence'      => 'required',
                'allowEmpty'    => false,
                'messages'      => array(
                    0 => 'Please specify username.'
                )
            ),
            'password'  => array(
                'presence'      => ($data['password'] != '' || $data['id'] == "")?'required':"",
                'allowEmpty'    => ($data['password'] != '' || $data['id'] == "")?false:true,
                new HCMS_Validate_PasswordConfirmation($data)
            ),
            'first_name'  => array(
                'presence'      => 'required',
                'allowEmpty'    => false,
                'messages'      => array(
                    0 => 'Please specify First Name .'
                )
            ),
            'last_name' => array(
                'presence'      => 'required',
                'allowEmpty'    => false,
                'messages'      => array(
                    0 => 'Please specify Last Name .'
                )
            ),
            'email' => array(
                'presence'      => 'required',
                'allowEmpty'    => false,
                new Zend_Validate_EmailAddress,
                 new Zend_Validate_Db_NoRecordExists(
                                array(
                                    'adapter' => Zend_Registry::get('db'),
                                    'table' => 'auth_user',
                                    'field' => 'email',
                                    'exclude' => array(
                                                        'field' => 'id',
                                                        'value' => $data['id']
                                                )
                                )
                            ),
                'messages'      => array(
                    0 => 'Please specify Email.'
                )
            ),
            'lang' => array(
                'presence'      => 'required',
                'allowEmpty'    => false,
                'messages'      => array(
                    0 => 'Please specify Language.'
                )
            ),
            'status' => array(
                'presence'      => 'required',
                'allowEmpty'    => false,
                'messages'      => array(
                    0 => 'Please specify Status.'
                )
            ),
            'image_path' => array(
                'allowEmpty'    => true
            )
        );
        parent::__construct($filterRules,$validatorRules, $data, $options);
    }
}

