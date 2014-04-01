<?php
/**
 * Get an Item
 */
class zsEventGetProcessor extends modObjectGetProcessor {
	public $objectType = 'zsEvent';
	public $classKey = 'zsEvent';
	public $languageTopics = array('fundzsevents:default');
}

return 'zsEventGetProcessor';