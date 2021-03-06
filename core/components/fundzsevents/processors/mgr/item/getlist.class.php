<?php
/**
 * Get a list of Items
 */
class zsEventGetListProcessor extends modObjectGetListProcessor {
	public $objectType = 'zsEvent';
	public $classKey = 'zsEvent';
	public $defaultSortField = 'id';
	public $defaultSortDirection = 'DESC';
	public $renderers = '';


	/**
	 * @param xPDOQuery $c
	 *
	 * @return xPDOQuery
	 */
	public function prepareQueryBeforeCount(xPDOQuery $c) {
		return $c;
	}


	/**
	 * @param xPDOObject $object
	 *
	 * @return array
	 */
	public function prepareRow(xPDOObject $object) {
		$array = $object->toArray();
		$owner = $object->getOne('User');
		$ownerProfile = $owner->getOne('Profile');
        $array['owner_fullname'] = $ownerProfile->get('fullname');
		return $array;
	}

}

return 'zsEventGetListProcessor';