<?php
/**
 * Group::beforeCanEdit()とafterCanEdit()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsModelTestCase', 'NetCommons.TestSuite');
App::uses('GroupFixture', 'Groups.Test/Fixture');

/**
 * Group::beforeCanEdit()とafterCanEdit()のテスト
 *
 * @author Masaki Goto <go8ogle@gmail.com>
 * @package NetCommons\Groups\Test\Case\Model\Group
 */
class GroupCanEditTest extends NetCommonsModelTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.groups.group',
		'plugin.groups.groups_user',
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
	protected $_methodName = 'canEdit';

/**
 * canEditのDataProvider
 *
 * @return array
 */
	public function dataProviderCanEdit() {
		return array(
			array(
				'groupId' => '1',
				'userId' => '4',
				'expected' => true,
			),
			array(
				'groupId' => '1',
				'userId' => '5',
				'expected' => false,
			),
			array(
				'groupId' => '',
				'user_id' => '4',
				'expected' => false,
			),
		);
	}

/**
 * canEdit()のテスト
 *
 * @param $groupId グループID
 * @param $userId ユーザID
 * @param array $expected 期待値
 * @dataProvider dataProviderCanEdit
 * @return void
 */
	public function testCanEdit($groupId, $userId, $expected) {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		Current::write('User.id', $userId);

		//テスト実施
		$result = $this->$model->$methodName($groupId);

		//チェック
		$this->assertEquals($expected, $result);
	}

}
