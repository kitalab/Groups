<?php
/**
 * Group::getGroupById()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsGetTest', 'NetCommons.TestSuite');

/**
 * Group::getGroupById()のテスト
 *
 * @author Masaki Goto <go8ogle@gmail.com>
 * @package NetCommons\Groups\Test\Case\Model\Group
 */
class GroupGetGroupByIdTest extends NetCommonsGetTest {

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
	protected $_methodName = 'getGroupById';

/**
 * getGroupByIdのDataProvider
 * 
 * @return array
 */
	public function dataProviderGetGroupById() {
		return array(
			array(
				'groupId' => '1',
				'expected' => 'array',
			),
			array(
				'groupId' => '',
				'expected' => 'array',
			),
			array(
				'groupId' => 'abc',
				'expected' => 'array',
			),
			array(
				'groupId' => '99',
				'expected' => 'array',
			),
		);
	}

/**
 * getGroupById()のテスト
 *
 * @param $groupId グループID
 * @param array $expected 期待値
 * @dataProvider dataProviderGetGroupById
 * @return void
 */
	public function testGetGroupById($groupId, $expected) {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//テスト実施
		$result = $this->$model->$methodName($groupId);

		//チェック
		$this->assertInternalType($expected, $result);
	}

}
