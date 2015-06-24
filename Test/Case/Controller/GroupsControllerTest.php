<?php
/**
 * GroupsController Test Case
 *
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('GroupsController', 'Groups.Controller');

/**
 * Summary for GroupsController Test Case
 */
class GroupsControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.groups.group',
		'plugin.rooms.room',
		'plugin.public_space.space',
		'plugin.boxes.box',
		'plugin.blocks.block',
		'plugin.pages.page',
		'plugin.m17n.language',
		'plugin.groups.groups_language',
		'plugin.users.user',
		'plugin.groups.groups_user',
		'plugin.theme_settings.site_setting'
	);

/**
 * testIndex method
 *
 * @return void
 */
	public function testIndex() {
	}

/**
 * testView method
 *
 * @return void
 */
	public function testView() {
	}

/**
 * testAdd method
 *
 * @return void
 */
	public function testAdd() {
	}

/**
 * testEdit method
 *
 * @return void
 */
	public function testEdit() {
	}

/**
 * testDelete method
 *
 * @return void
 */
	public function testDelete() {
	}

}
