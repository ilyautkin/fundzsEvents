<?php
ini_set('display_errors',1);
if (empty($_REQUEST['action'])) {
	die('Access denied');
}
else {
	$action = $_REQUEST['action'];
}

define('MODX_API_MODE', true);
require_once dirname(dirname(dirname(dirname(__FILE__)))).'/index.php';

$modx->getService('error','error.modError');
$modx->getRequest();
$modx->setLogLevel(modX::LOG_LEVEL_ERROR);
$modx->setLogTarget('FILE');
$modx->error->message = null;

$ctx = !empty($_REQUEST['ctx']) ? $_REQUEST['ctx'] : 'web';
if ($ctx != 'web') {$modx->switchContext($ctx);}

// Get properties
$properties = array();

/* @var Tickets $Tickets */
define('MODX_ACTION_MODE', true);
$corePath = $modx->getOption('fundzsevents_core_path', null, $modx->getOption('core_path') . 'components/fundzsevents/');
require_once $modx->getOption('core_path') . 'components/fundzsevents/model/fundzsevents/fundzsevents.class.php';
$modx->fundzsevents = new fundzsEvents($modx);
if ($modx->error->hasError() || !($modx->fundzsevents instanceof fundzsEvents)) {
	die('Error');
}

switch ($action) {
	case 'attend': $response = $modx->fundzsevents->attend($_REQUEST['id']); break;
	default:
		$message = $_REQUEST['action'] != $action ? 'tickets_err_register_globals' : 'tickets_err_unknown';
		$response = $modx->toJSON(array('success' => false, 'message' => $modx->lexicon($message)));
}

if (is_array($response)) {
	$response = $modx->toJSON($response);
}

@session_write_close();
if ($_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') {
    if (empty($_SERVER['HTTP_REFERER'])) {
        $_SERVER['HTTP_REFERER'] = $_REQUEST['return'] ? $_REQUEST['return'] : $modx->getOption('site_url');
    }
    $modx->sendRedirect($_REQUEST['return']);
}
exit($response);