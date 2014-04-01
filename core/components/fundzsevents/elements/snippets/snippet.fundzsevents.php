<?php

$fundzsEvents = $modx->getService('fundzsevents','fundzsEvents',$modx->getOption('fundzsevents_core_path',null,$modx->getOption('core_path').'components/fundzsevents/').'model/fundzsevents/',$scriptProperties);
if (!($fundzsEvents instanceof fundzsEvents)) return '';

/**
 * Do your snippet code here. This demo grabs 5 items from our custom table.
 */
$tpl = $modx->getOption('tpl',$scriptProperties,'Item');
$sortBy = $modx->getOption('sortBy',$scriptProperties,'name');
$sortDir = $modx->getOption('sortDir',$scriptProperties,'ASC');
$limit = $modx->getOption('limit',$scriptProperties,5);
$outputSeparator = $modx->getOption('outputSeparator',$scriptProperties,"\n");

/* build query */
$c = $modx->newQuery('fundzsEventsItem');
$c->sortby($sortBy,$sortDir);
$c->limit($limit);
$items = $modx->getCollection('fundzsEventsItem',$c);

/* iterate through items */
$list = array();
/* @var fundzsEventsItem $item */
foreach ($items as $item) {
	$itemArray = $item->toArray();
	$list[] = $fundzsEvents->getChunk($tpl,$itemArray);
}

/* output */
$output = implode($outputSeparator,$list);
$toPlaceholder = $modx->getOption('toPlaceholder',$scriptProperties,false);
if (!empty($toPlaceholder)) {
	/* if using a placeholder, output nothing and set output to specified placeholder */
	$modx->setPlaceholder($toPlaceholder,$output);
	return '';
}
/* by default just return output */
return $output;