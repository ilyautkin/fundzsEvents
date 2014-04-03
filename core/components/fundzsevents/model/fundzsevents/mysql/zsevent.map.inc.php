<?php
$xpdo_meta_map['zsEvent']= array (
  'package' => 'fundzsevents',
  'version' => '1.1',
  'table' => 'fundzs_events',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'name' => '',
    'city' => '',
    'begin' => NULL,
    'end' => NULL,
    'address' => '',
    'description' => '',
    'comment' => '',
    'owner' => 0,
  ),
  'fieldMeta' => 
  array (
    'name' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'city' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'begin' => 
    array (
      'dbtype' => 'datetime',
      'phptype' => 'datetime',
      'null' => true,
      'index' => 'index',
    ),
    'end' => 
    array (
      'dbtype' => 'datetime',
      'phptype' => 'datetime',
      'null' => true,
      'index' => 'index',
    ),
    'address' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => true,
      'default' => '',
    ),
    'description' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'text',
      'null' => true,
      'default' => '',
    ),
    'comment' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'text',
      'null' => true,
      'default' => '',
    ),
    'owner' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'phptype' => 'integer',
      'attributes' => 'unsigned',
      'null' => false,
      'default' => 0,
      'index' => 'index',
    ),
  ),
  'indexes' => 
  array (
    'begin' => 
    array (
      'alias' => 'begin',
      'primary' => false,
      'unique' => false,
      'type' => 'BTREE',
      'columns' => 
      array (
        'begin' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
    'owner' => 
    array (
      'alias' => 'owner',
      'primary' => false,
      'unique' => false,
      'type' => 'BTREE',
      'columns' => 
      array (
        'owner' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
  ),
  'composites' => 
  array (
    'Participants' => 
    array (
      'class' => 'zsParticipant',
      'local' => 'id',
      'foreign' => 'event',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
  'aggregates' => 
  array (
    'User' => 
    array (
      'class' => 'modUser',
      'local' => 'owner',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
