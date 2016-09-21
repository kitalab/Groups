<?php
/**
 * GroupFixture
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

/**
 * Summary for GroupFixture
 */
class GroupFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created_user' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified_user' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'created_user' => array('column' => array('created_user', 'created'), 'unique' => 0)
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
			'name' => 'Lorem ipsum dolor sit amet',
			'created_user' => '4',
			'created' => '2015-03-09 09:25:20',
			'modified_user' => '4',
			'modified' => '2015-03-09 09:25:20',
		),
		array(
			'id' => '2',
			'name' => 'Lorem ipsum dolor sit amet',
			'created_user' => '5',
			'created' => '2015-03-09 09:25:20',
			'modified_user' => '5',
			'modified' => '2015-03-09 09:25:20',
		),
		array(
			'id' => '3',
			'name' => 'Lorem ipsum dolor sit amet',
			'created_user' => '1',
			'created' => '2015-03-09 09:25:20',
			'modified_user' => '1',
			'modified' => '2015-03-09 09:25:20',
		),
	);
}
