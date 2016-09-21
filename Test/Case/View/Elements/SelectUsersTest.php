<?php
/**
 * View/Elements/select_usersのテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsControllerTestCase', 'NetCommons.TestSuite');

/**
 * View/Elements/select_usersのテスト
 *
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @package NetCommons\Groups\Test\Case\View\Elements\SelectUsers
 */
class GroupsViewElementsSelectUsersTest extends NetCommonsControllerTestCase {

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
		//テストコントローラ生成
		$this->generateNc('TestGroups.TestViewElementsSelectUsers');
	}

/**
 * View/Elements/select_usersのテスト
 *
 * @return void
 */
	public function testSelectUsers() {
		$this->controller->set('roomId', 1);
		//テスト実行
		$this->_testGetAction('/test_groups/test_view_elements_select_users/select_users',
				array('method' => 'assertNotEmpty'), null, 'view');

		//チェック
		$pattern = '/' . preg_quote('View/Elements/select_users', '/') . '/';
		$this->assertRegExp($pattern, $this->view);

		$this->assertContains(sprintf(__d('groups', 'Select user')), $this->view);
	}

}
