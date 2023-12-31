<?php

/**
 * This script updates all modules.
 *
 * Running this script on the CLI is better than clicking 'update' in the
 * admin dashboard because some module updates may take a long time.
 */
require_once __DIR__ . '/common.php';

Context::init();
$oModuleModel = getModel('module');

// Get the list of modules that need to be updated.
$module_list = $oModuleModel->getModuleList();
$need_install = array();
$need_update = array();
foreach($module_list as $key => $value)
{
	if($value->need_install)
	{
		$need_install[] = $value->module;
	}
	if($value->need_update)
	{
		$need_update[] = $value->module;
	}
}

// Install all modules.
$oInstallController = InstallController::getInstance();
foreach ($need_install as $module)
{
	try
	{
		echo 'Installing ' . $module . '...' . PHP_EOL;
		$oInstallController->installModule($module, './modules/' . $module);
	}
	catch (\Exception $e)
	{
		echo 'Error: ' . $e->getMessage() . PHP_EOL;
	}
}

// Update all modules.
foreach ($need_update as $module)
{
	try
	{
		echo 'Updating ' . $module . '...' . PHP_EOL;
		$oInstallController->updateModule($module);
	}
	catch (\Exception $e)
	{
		echo 'Error: ' . $e->getMessage() . PHP_EOL;
	}
}

// Set the exit status if there were any errors.
if ($exit_status != 0)
{
	exit($exit_status);
}
