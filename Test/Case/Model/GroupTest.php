<?php
/**
 * Group Test Case
 *
* @author   Jun Nishikawa <topaz2@m0n0m0n0.com>
* @link     http://www.netcommons.org NetCommons Project
* @license  http://www.netcommons.org/license.txt NetCommons License
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
		'plugin.groups.room',
		'plugin.groups.space',
		'plugin.groups.box',
		'plugin.groups.top_page',
		'plugin.groups.block',
		'plugin.groups.page',
		'plugin.groups.language',
		'plugin.groups.groups_language',
		'plugin.groups.user',
		'plugin.groups.groups_user'
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

}
