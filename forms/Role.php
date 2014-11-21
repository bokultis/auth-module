<?php
/**
 * Role add/edit form
 *
 * @package Modules
 * @subpackage Auth
 * @copyright Horisen
 * @author marko
 */
class Auth_Form_Role extends HCMS_Form_Simple
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
            'parent_id'  => array(
                'presence'      => 'required',
                'allowEmpty'    => false,
                'messages'      => array(
                    0 => 'Please specify parent.'
                )
            ),
            'name'  => array(
                'presence'      => 'required',
                'allowEmpty'    => false,
                'messages'      => array(
                    0 => 'Please specify name.'
                )
            )
        );
        parent::__construct($filterRules,$validatorRules, $data, $options);
    }
}

