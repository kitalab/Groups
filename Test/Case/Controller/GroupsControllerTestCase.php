<?php
/**
 * GroupsControllerのテストケース
 *
 * @author Yuna Miyashita <butackle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('GroupFixture', 'Groups.Test/Fixture');
App::uses('GroupsUserFixture', 'Groups.Test/Fixture');
App::uses('NetCommonsControllerTestCase', 'NetCommons.TestSuite');

/**
 * GroupsControllerのテストケース
 *
 * @author Yuna Miyashita <butackle@gmail.com>
 * @package NetCommons\Groups\Test\Case\Controller
 */
class GroupsControllerTestCase extends NetCommonsControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.groups.group',
		'plugin.groups.groups_user',
		'plugin.groups.page4_groups_test',
		'plugin.groups.roles_rooms_user4_groups_test',
		'plugin.groups.room4_groups_test',
		'plugin.groups.user_attribute_layout4_groups_test',
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
 * グループModel
 * 
 * @var object
 */
	protected $__group;

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

		$this->__group = $this->controller->Group;
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
 * 登録データ内容の確認
 *
 * @param $dbData	DBから取得したデータ
 * @param $inputData	入力したデータ
 * @param $expectedSaveResult	セーブ結果(想定)
 * @return void
 */
	protected function _assertGroupData($dbData, $inputData, $expectedSaveResult) {
		$isEdit = isset($inputData['Group']);
		$inputGroupUserData = isset($inputData['GroupsUser']) ? $inputData['GroupsUser'] : null;
		//登録データ詳細を取得
		$saveGroupsData = $dbData[0]['Group'];
		$saveGroupsUserData = $dbData[0]['GroupsUser'];
		//登録したユーザ数を確認
		$expectedGroupUserCnt = ($expectedSaveResult || $isEdit) ? count($inputGroupUserData) : 0;
		$this->assertCount($expectedGroupUserCnt, $saveGroupsUserData);
		//グループID・グループ名が正しく登録されているかを確認
		if ($isEdit) {
			$this->assertEquals($inputData['Group']['id'], $saveGroupsData['id']);
			$expectedUserName = $inputData['Group']['name'];
		} else {
			$expectedUserName = $inputData['name'];
		}
		$this->assertEquals($expectedUserName, $saveGroupsData['name']);
		//グループユーザが正しく登録されているかを確認
		$saveGroupId = $saveGroupsData['id'];
		foreach ($saveGroupsUserData as $index => $actualUserData) {
			$expectedUserId = $inputGroupUserData[$index]['user_id'];
			$actualUserId = $actualUserData['user_id'];
			$actualGroupId = $actualUserData['group_id'];
			$this->assertEquals($saveGroupId, $actualGroupId);
			$this->assertEquals($expectedUserId, $actualUserId);
		}
	}

/**
 * exceptionのエラーを返す
 * 
 * @param $exception
 */
	protected function _assertException($exception = null) {
			if (is_null($exception)) {
				return;
			}

			$errMessage = "Error:" . $exception->getCode() . "　" . $exception->getMessage() . "\r\n";
			$errMessage .= $exception->getFile() . "  Line:" . $exception->getLine() . "\r\n";
			//$errMessage .= "\r\n".$exception->getTraceAsString()."\r\n";

			$this->assertFalse(true, $errMessage);
	}

/**
 * フィクスチャに入っているデータを返す
 * 
 * @return array 
 */
	protected function _getFixtureData() {
		$groupFixture = new GroupFixture();
		$groupsUserFixture = new GroupsUserFixture();
		$groupData = $groupFixture->records[0];
		$groupUserData = $groupsUserFixture->records[0];

		return array(
			'Group' => [
				'id' => $groupData['id'],
				'name' => $groupData['name'],
			],
			'GroupsUser' => [
				['user_id' => $groupUserData['user_id']]
			]
		);
	}

/**
 * paramにIDを入れるテストのdataProvider
 * 
 * ### 戻り値
 *  - id : ID
 *  - exception:	想定されるエラー
 */
	public function dataProviderParamId() {
		return array(
			array(
				'id' => 1,
				'exception' => null
			),
			array(
				'id' => 99,
				'exception' => 'NotFoundException'
			),
			array(
				'id' => null,
				'exception' => 'NotFoundException'
			)
		);
	}
}
