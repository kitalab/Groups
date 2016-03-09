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
 * @param $isModal		モーダル表示の有無
 * @param $inputData	入力するデータ
 * @return void
 */
	public function testAddPost($isModel = null, $inputData = []) {
		$this->_testPostAction(
			'post',
			$inputData,
			array('action' => 'add', $isModel),
			null,
			'view'
		);
	}

/**
 * testAddPost用dataProvider
 * 
 * ### 戻り値
 *  - isModal:		モーダル表示の有無
 *  - inputData:	入力データ
 */
	public function dataProviderAddPost() {
		return array(
			array(
				'isModal' => false,
				'inputData' => [
					'name' => 'test1',
					'GroupsUser' => [['user_id' => '1']]
				]
			),
			array(
				'isModal' => false,
				'inputData' => [
					'name' => 'test2',
					'GroupsUser' => [['user_id' => '1']]
				]
			),
			array(
				'isModal' => true,
				'inputData' => [
					'name' => '',
					'GroupsUser' => [['user_id' => '1']]
				]
			),
			array(
				'isModal' => true,
				'inputData' => [
					'name' => 'test4',
					'GroupsUser' => [['user_id' => '1']]
				]
			),
		);
	}

}
