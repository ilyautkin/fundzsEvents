<?php
/**
 * Update an Item
 */
class fundzsEventsItemUpdateProcessor extends modObjectUpdateProcessor {
	public $objectType = 'fundzsEventsItem';
	public $classKey = 'fundzsEventsItem';
	public $languageTopics = array('fundzsevents');
	public $permission = 'edit_document';
}

return 'fundzsEventsItemUpdateProcessor';
