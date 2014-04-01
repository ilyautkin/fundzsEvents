<?php
/**
 * Remove an Item
 */
class zsEventRemoveProcessor extends modObjectRemoveProcessor {
	public $checkRemovePermission = true;
	public $objectType = 'zsEvent';
	public $classKey = 'zsEvent';
	public $languageTopics = array('fundzsevents');

}

return 'zsEventRemoveProcessor';