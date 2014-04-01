<?php

switch ($modx->event->name) {

	case 'OnManagerPageInit':
		$cssFile = MODX_ASSETS_URL.'components/fundzsevents/css/mgr/main.css';
		$modx->regClientCSS($cssFile);
		break;

}