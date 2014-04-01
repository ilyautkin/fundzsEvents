<?php
/**
 * Get an Item
 */
class fundzsEventsItemGetProcessor extends modObjectGetProcessor {
	public $objectType = 'fundzsEventsItem';
	public $classKey = 'fundzsEventsItem';
	public $languageTopics = array('fundzsevents:default');
}

return 'fundzsEventsItemGetProcessor';