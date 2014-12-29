<?php
/**
 * Smarty plugin
 *
 * @package Smarty
 * @subpackage PluginsModifier
 */
 
/**
 * Smarty acl plugin for Zend
 *
 */
function smarty_block_privileged($params, $content, Smarty_Internal_Template $template, &$repeat) {
    
	$privilege = (isset($params['privilege'])) ? $params['privilege'] : '';
	$acl = Zend_Registry::get('acl');
	$request = Zend_Controller_Front::getInstance()->getRequest();
	$auth = Zend_Auth::getInstance();
    $userRole = @$auth->getStorage()->read()->role;
    $isAllowed = $acl->isAllowed($userRole, $request->getModuleName() . ':' . $request->getControllerName(),
        	 $privilege); 
        	 
	if($isAllowed)
    	return $content;
} 

?>