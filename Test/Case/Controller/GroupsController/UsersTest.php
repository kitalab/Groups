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

App::uses('GroupsControllerTestCase', 'Groups.Test/Case/Controller');

/**
 * GroupsController::users()のテスト
 *
 * @author Yuna Miyashita <butackle@gmail.com>
 * @package NetCommons\Groups\Test\Case\Controller\GroupsController
 */
class GroupsControllerUsersTest extends GroupsControllerTestCase {

/**
 * Fixtures Setting
 *
 * @var array
 */
	public function __construct($name = null, array $data = array(), $dataName = '') {
		$this->fixtures = array_merge(
			$this->fixtures,
			[
				'plugin.groups.group4_users_test',
				'plugin.groups.groups_user4_users_test'
			]
		);

		parent::__construct($name, $data, $dataName);
	}

/**
 * users()アクションのGetリクエストテスト
 * 
 * @dataProvider dataProviderUsersGet
 * @param $groupIds : 対象グループID
 * @param $expectedGroupUsers:	取得予定ユーザ情報
 * @return void
 */
	public function testUsersGet($groupIds = ['group_id' => 1], $expectedGroupUsers = []) {
		//テスト実行
		$this->_testGetAction(
			array('action' => 'users', '?' => $groupIds ),
			array('method' => 'assertNotEmpty'),
			null,
			'view'
		);
		$actualUsers = json_decode($this->view);

		//Jsonの値を確認
		$this->assertEquals(
			'OK', $actualUsers->name
		);
		$this->assertEquals(
			200, $actualUsers->code
		);
		//ユーザ情報を確認
		$this->assertEquals(
			$expectedGroupUsers, $actualUsers->users
		);
	}

/**
 * testUsersGet用dataProvider
 * 
 * ### 戻り値
 *  - groupIds : 対象グループID
 *  - expectedGroupUsers:	取得予定ユーザ情報
 */
	public function dataProviderUsersGet() {
		$testData = array();
		//データが帰ってこないID
		$emptyUserIds = array(
			null,
			$this->__createGroupIdsQuery(null),
			$this->__createGroupIdsQuery(35444),
			$this->__createGroupIdsQuery('ああああ'),
			$this->__createGroupIdsQuery(2, 'errorKey'),
		);
		foreach ($emptyUserIds as $emptyUserId) {
			$testData[] = array(
				'groupIds' => $emptyUserId,
				'expectedGroupUsers' => []
			);
		}
		//MUST:データが帰ってくるIDのテストケースを追加

		return $testData;
	}

/**
 * 取得対象のグループIDを指定するクエリの配列を作成する
 * 
 * @param string　値
 * @param string キー
 * @return array
 */
	private function __createGroupIdsQuery($value, $key = 'group_id') {
		return [$key => $value];
	}
}
