<?php
/**
 * GroupsComponent::setGroupList()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Yuna Miyashita <butackle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsControllerTestCase', 'NetCommons.TestSuite');

/**
 * GroupsComponent::setGroupList()のテスト
 *
 * @author Yuna Miyashita <butackle@gmail.com>
 * @package NetCommons\Groups\Test\Case\Controller\Component\GroupsComponent
 */
class GroupsComponentSetGroupListTest extends NetCommonsControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array();

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
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		//ログアウト
		TestAuthGeneral::logout($this);

		parent::tearDown();
	}

/**
 * setGroupList()のテスト
 *
 * @return void
 */
	public function testSetGroupList() {
		//テストコントローラ生成
		$this->generateNc('TestGroups.TestGroupsComponent');

		//ログイン
		TestAuthGeneral::login($this);

		//テストアクション実行
		$this->_testGetAction('/test_groups/test_groups_component/index',
				array('method' => 'assertNotEmpty'), null, 'view');
		$pattern = '/' . preg_quote('Controller/Component/TestGroupsComponent', '/') . '/';
		$this->assertRegExp($pattern, $this->view);

		//テストデータ生成
		$query = array();

		//テスト実行
		$this->controller->Groups->setGroupList($query, $this->controller);

		//SHOULD:必要に応じてassert追加する
		debug($this->controller->viewVars);
	}

}
