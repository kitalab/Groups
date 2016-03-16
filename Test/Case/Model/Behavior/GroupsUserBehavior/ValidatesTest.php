<?php
/**
 * GroupsUserBehavior::validates()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Yuna Miyashita <butackle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsModelTestCase', 'NetCommons.TestSuite');
App::uses('TestGroupsUserBehaviorValidatesModelFixture', 'Groups.Test/Fixture');

/**
 * GroupsUserBehavior::validates()のテスト
 *
 * @author Yuna Miyashita <butackle@gmail.com>
 * @package NetCommons\Groups\Test\Case\Model\Behavior\GroupsUserBehavior
 */
class GroupsUserBehaviorValidatesTest extends NetCommonsModelTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.groups.test_groups_user_behavior_validates_model',
	);

/**
 * Plugin name
 *
 * @var string
 */
	public $plugin = 'groups';

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		//テストプラグインのロード
		NetCommonsCakeTestCase::loadTestPlugin($this, 'Groups', 'TestGroups');
		$this->TestModel = ClassRegistry::init('TestGroups.TestGroupsUserBehaviorValidatesModel');
	}

/**
 * validates()のテスト
 *
 * @return void
 */
	public function testValidates() {
		//テストデータ
		$data = array(
			'TestGroupsUserBehaviorValidatesModel' => (new TestGroupsUserBehaviorValidatesModelFixture())->records[0],
		);

		//テスト実施
		$this->TestModel->set($data);
		$result = $this->TestModel->validates();

		//チェック
		//SHOULD:Assertを書く
		debug($this->TestModel->validationErrors);
		debug($result);
	}

}
