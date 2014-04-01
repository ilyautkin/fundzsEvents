<?php
/**
 * Remove an Item
 */
class fundzsEventsItemRemoveProcessor extends modObjectRemoveProcessor {
	public $checkRemovePermission = true;
	public $objectType = 'fundzsEventsItem';
	public $classKey = 'fundzsEventsItem';
	public $languageTopics = array('fundzsevents');

}

return 'fundzsEventsItemRemoveProcessor';