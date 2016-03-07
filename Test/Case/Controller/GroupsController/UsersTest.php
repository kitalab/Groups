<?php
/**
 * GroupsController::users()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Yuna Miyashita <butackle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsControllerTestCase', 'NetCommons.TestSuite');

/**
 * GroupsController::users()のテスト
 *
 * @author Yuna Miyashita <butackle@gmail.com>
 * @package NetCommons\Groups\Test\Case\Controller\GroupsController
 */
class GroupsControllerUsersTest extends NetCommonsControllerTestCase {

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
 * Controller name
 *
 * @var string
 */
	protected $_controller = 'groups';

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		//ログイン
		TestAuthGeneral::login($this);
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
 * users()アクションのGetリクエストテスト
 *
 * @return void
 */
	public function testUsersGet() {
		//テスト実行
		$this->_testGetAction(array('action' => 'users'), array('method' => 'assertNotEmpty'), null, 'view');

		//チェック
		//TODO:assert追加
		debug($this->view);
	}

}
