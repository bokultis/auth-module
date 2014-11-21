<?php

/**
 * Admin controller
 *
 * @package Auth
 * @subpackage Controllers
 * @copyright Horisen
 * @author milan
 */
class Auth_AdminController extends HCMS_Controller_Action_Admin {
    public function widgetAction(){
        if($this->getRequest()->isXmlHttpRequest()) {
            $this->getHelper('layout')->disableLayout();
        }        
    }
}