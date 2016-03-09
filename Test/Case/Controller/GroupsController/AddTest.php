<?php
/**
 * GroupsController::add()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Yuna Miyashita <butackle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsControllerTestCase', 'NetCommons.TestSuite');

/**
 * GroupsController::add()のテスト
 *
 * @author Yuna Miyashita <butackle@gmail.com>
 * @package NetCommons\Groups\Test\Case\Controller\GroupsController
 */
class GroupsControllerAddTest extends NetCommonsControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.groups.group',
		'plugin.groups.groups_user',
		'plugin.private_space.roles_rooms_user4test',
		'plugin.private_space.room4test',
		'plugin.user_attributes.user_attribute_layout',
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
		CakeSession::write('Auth.User.UserRoleSetting.use_private_room', true);
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
 * add()アクションのPostリクエストテスト
 *
 * @dataProvider dataProviderAddPost
 * @return void
 */
	public function testAddPost($isModel, $data) {
		$this->_testPostAction(
			'post',
			$data,
			array('action' => 'add', $isModel),
			null,
			'view'
		);
	}

/**
 * testAddPost用dataProvider
 * 
 * ### 戻り値
 *  - isModal:	モーダル表示の有無
 *  - data:		入力データ
 */
	public function dataProviderAddPost() {
		return array(
			[
				"isModal" => true,
				"data" => ["Test" => "Test", "GroupsUser" => "1"]
			],
			[
				"isModal" => false,
				"data" => ["Test" => "Test", "GroupsUser" => "1"]
			],
		);
	}

}
