<?php
/**
 * Group Test Case
 *
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('Group', 'Groups.Model');

/**
 * Summary for Group Test Case
 */
class GroupTest extends CakeTestCase {

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
		'plugin.users.groups_user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Group = ClassRegistry::init('Groups.Group');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Group);

		parent::tearDown();
	}

/**
 * testIndex method
 *
 * @return void
 */
	public function testIndex() {
	}

}
