<?php
/**
 * GroupsUserFixture
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

/**
 * Summary for GroupsUserFixture
 */
class GroupsUserFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'group_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'created_user' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified_user' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'group_id' => array('column' => 'group_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '1',
			'group_id' => '1',
			'user_id' => '4',
			'created_user' => '4',
			'created' => '2015-03-09 09:25:20',
			'modified_user' => '4',
			'modified' => '2015-03-09 09:25:20',
		),
		array(
			'id' => '2',
			'group_id' => '1',
			'user_id' => '5',
			'created_user' => '4',
			'created' => '2015-03-09 09:25:20',
			'modified_user' => '4',
			'modified' => '2015-03-09 09:25:20',
		),
		array(
			'id' => '3',
			'group_id' => '2',
			'user_id' => '4',
			'created_user' => '4',
			'created' => '2015-03-09 09:25:20',
			'modified_user' => '4',
			'modified' => '2015-03-09 09:25:20',
		),
	);
}
