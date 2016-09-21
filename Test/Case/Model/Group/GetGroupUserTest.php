<?php
/**
 * Group::getGroupUser()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsGetTest', 'NetCommons.TestSuite');

/**
 * Group::getGroupUser()のテスト
 *
 * @author Masaki Goto <go8ogle@gmail.com>
 * @package NetCommons\Groups\Test\Case\Model\Group
 */
class GroupGetGroupUserTest extends NetCommonsGetTest {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.groups.group',
		'plugin.groups.groups_user',
		'plugin.rooms.room_role',
	);

/**
 * Plugin name
 *
 * @var string
 */
	public $plugin = 'groups';

/**
 * Model name
 *
 * @var string
 */
	protected $_modelName = 'Group';

/**
 * Method name
 *
 * @var string
 */
	protected $_methodName = 'getGroupUser';

/**
 * getGroupUserのDataProvider
 *
 * @return array
 */
	public function dataProviderGetGroupUser() {
		return array(
			array(
				'groupId' => '1',
				'roomId' => '',
				'expected' => 'array',
			),
			array(
				'groupId' => '2',
				'roomId' => '1',
				'expected' => 'array',
			),
			array(
				'groupId' => '',
				'roomId' => '',
				'expected' => 'array',
			),
		);
	}

/**
 * getGroupUser()のテスト
 * @param $groupId グループID
 * @param $roomId ルームID
 * @param array $expected 期待値
 * @dataProvider dataProviderGetGroupUser
 * @return void
 */
	public function testGetGroupUser($groupId, $roomId, $expected) {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//テスト実施
		$result = $this->$model->$methodName($groupId, $roomId);

		//チェック
		$this->assertInternalType($expected, $result);
	}

}
