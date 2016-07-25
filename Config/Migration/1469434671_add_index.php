<?php
/**
 * Migration file
 *
 * @author Kazutaka Yamada <yamada.kazutaka@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

/**
 * Groups CakeMigration
 *
 * @author Kazutaka Yamada <yamada.kazutaka@withone.co.jp>
 * @package NetCommons\Groups\Config\Migration
 */
class AddIndex extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'add_index';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(
			'alter_field' => array(
				'groups' => array(
					'created_user' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
				),
				'groups_users' => array(
					'group_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
				),
			),
			'create_field' => array(
				'groups' => array(
					'indexes' => array(
						'created_user' => array('column' => array('created_user', 'created'), 'unique' => 0),
					),
				),
				'groups_users' => array(
					'indexes' => array(
						'group_id' => array('column' => 'group_id', 'unique' => 0),
					),
				),
			),
		),
		'down' => array(
			'alter_field' => array(
				'groups' => array(
					'created_user' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
				),
				'groups_users' => array(
					'group_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
				),
			),
			'drop_field' => array(
				'groups' => array('indexes' => array('created_user')),
				'groups_users' => array('indexes' => array('group_id')),
			),
		),
	);

/**
 * Before migration callback
 *
 * @param string $direction Direction of migration process (up or down)
 * @return bool Should process continue
 */
	public function before($direction) {
		return true;
	}

/**
 * After migration callback
 *
 * @param string $direction Direction of migration process (up or down)
 * @return bool Should process continue
 */
	public function after($direction) {
		return true;
	}
}
