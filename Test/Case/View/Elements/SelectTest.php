<?php
/**
 * View/Elements/selectのテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsControllerTestCase', 'NetCommons.TestSuite');
App::uses('UserSearchHelper', 'Users.View/Helper');

/**
 * View/Elements/selectのテスト
 *
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @package NetCommons\Groups\Test\Case\View\Elements\Select
 */
class GroupsViewElementsSelectTest extends NetCommonsControllerTestCase {

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

		$view = new View();
		new UserSearchHelper($view);

		//テストプラグインのロード
		NetCommonsCakeTestCase::loadTestPlugin($this, 'Groups', 'TestGroups');
		//テストコントローラ生成
		$this->generateNc('TestGroups.TestViewElementsSelect');
	}

/**
 * View/Elements/selectのテスト
 *
 * @return void
 */
	public function testSelect() {
		$this->controller->set('selectUsers', array(
			0 => array(
				'User' => array(
					'id' => 1
				)
			)
		));
		//テスト実行
		$this->_testGetAction('/test_groups/test_view_elements_select/select',
				array('method' => 'assertNotEmpty'), null, 'view');

		//チェック
		$pattern = '/' . preg_quote('View/Elements/select', '/') . '/';
		$this->assertRegExp($pattern, $this->view);

		$this->assertContains(sprintf(__d('groups', 'Select user')), $this->view);
	}

}
