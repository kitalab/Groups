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
App::uses('GroupsUser4UsersTestFixture', 'Groups.Test/Fixture');

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
 * @param $paramGroupId : 対象グループID
 * @param $existUserData:	ユーザ情報が返ってくるか否か
 * @return void
 */
	public function testUsersGet($paramGroupId, $existUserData) {
		//テスト実行
		$this->_testGetAction(
			array('action' => 'users', '?' => $paramGroupId ),
			array('method' => 'assertNotEmpty'),
			null,
			'view'
		);
		$actualJson = json_decode($this->view);

		//Jsonの値を確認
		$this->assertEquals(
			'OK', $actualJson->name
		);
		$this->assertEquals(
			200, $actualJson->code
		);
		$actualUsers = $actualJson->users;
		//Userデータを取得しない場合には空データ確認をした後、処理終了
		if (!$existUserData) {
			$this->assertEquals(
				[], $actualUsers
			);
			return;
		}
		//取得予定のユーザ情報をフィクスチャから取得し、データ数を比較
		$expectedUserIds = $this->__getExpectedUserIds($paramGroupId);
		$this->assertCount(
			count($expectedUserIds),
			$actualUsers
		);
		//データ内容を検証
		foreach ($expectedUserIds as $index => $expectedUserId) {
			//取得予定ユーザ情報を取得
			$dbUserData = $this->controller->View->UserSearch->convertUserArrayByUserSelection(
				$this->controller->User->findById($expectedUserId),
				'User'
			);
			//jsonで取得したユーザ情報を検証
			$actualUser = (array)$actualUsers[$index];
			$this->assertCount(
				count($dbUserData),
				$actualUser
			);
			foreach (array_keys($dbUserData) as $key) {
				$this->assertEquals(
					$dbUserData[$key],
					$actualUser[$key]
				);
			}
		}
	}

/**
 * 取得予定のユーザ情報をフィクスチャから取得
 * 
 * @param $paramGroupId
 * @return array
 */
	private function __getExpectedUserIds($paramGroupId) {
		$expectedUserIds = array();

		$groupUsers = new GroupsUser4UsersTestFixture();
		$expectedGroupIds = explode(',', array_pop($paramGroupId));
		foreach ($groupUsers->records as $record) {
			if (in_array($record['group_id'], $expectedGroupIds)) {
				$expectedUserIds[] = (int)$record['user_id'];
			}
		}

		sort($expectedUserIds);
		return array_values(array_unique($expectedUserIds));
	}

/**
 * testUsersGet用dataProvider
 * 
 * ### 戻り値
 *  - groupIds : 対象グループID
 *  - existUserData:	ユーザ情報が返ってくるか否か
 */
	public function dataProviderUsersGet() {
		return array(
			[ [ 'group_id' => '1,2'], true ],
			[ [ 'group_id' => '2,1'], true ],
			[ [ 'group_id' => '3,1'], true ],
			[ [ 'group_id' => '2,4'], true ],
			[ [ 'group_id' => 1], true ],
			[ [ 'group_id' => 2], true ],
			[ null, false ],
			[ [ 'group_id' => null], false ],
			[ [ 'group_id' => 35444], false ],
			[ [ 'group_id' => 'ああああ'], false ],
			[ [ 'errorKey' => 2 ], false ],
		);
	}
}
