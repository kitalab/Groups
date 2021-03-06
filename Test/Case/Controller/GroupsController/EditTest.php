<?php
/**
 * GroupsController::edit()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Yuna Miyashita <butackle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('GroupsControllerTestBase', 'Groups.Test/Case');
App::uses('GroupFixture', 'Groups.Test/Fixture');
App::uses('GroupsUserFixture', 'Groups.Test/Fixture');

/**
 * GroupsController::edit()のテスト
 *
 * @author Yuna Miyashita <butackle@gmail.com>
 * @package NetCommons\Groups\Test\Case\Controller\GroupsController
 */
class GroupsControllerEditTest extends GroupsControllerTestBase {

/**
 * edit()アクションのGetリクエストテスト
 *
 * @dataProvider dataProviderParamId
 * @param $id ID
 * @param $exception	想定されるエラー
 * @return void
 */
	public function testEditGet($id, $exception) {
		//ログイン
		TestAuthGeneral::login($this);

		//テスト実行
		$this->_testGetAction(
			array('action' => 'edit', $id),
			array('method' => 'assertNotEmpty'),
			$exception,
			'view'
		);

		if (empty($exception)) {
			$this->_assertContainDeleteButton(true);
		}
	}

/**
 * edit()アクションのGetリクエストテスト(ログインなし)
 *
 * @return void
 */
	//public function testEditGetNotLogin() {
	//	$this->_assertNotLogin('edit');
	//}

/**
 * edit()アクションのPostリクエストテスト
 *
 * @dataProvider dataProviderEditPost
 * @param $rest REST
 * @param $inputData	入力するデータ
 * @param $expectedSaveResult	セーブ結果(想定)
 * @param $errMessage　画面に表示されるエラーメッセージ
 * @return void
 */
	public function testEditPost($rest = 'post', $inputData = [], $expectedSaveResult = 1, $errMessage = '') {
		//ログイン
		TestAuthGeneral::login($this);

		//データ編集
		try {
			$this->_testPostAction(
				$rest,
				$inputData,
				array('action' => 'edit', 1),
				null,
				'view'
			);
		} catch(exception $e){
			$this->_assertException($e);
		}
		$dbData = $this->_group->find('all');

		//登録データ数を確認
		$this->assertCount(1, $dbData);
		//表示ページ確認
		$this->_assertRedirect($expectedSaveResult, $errMessage);
		//データが編集されている場合には変わっているかどうか。編集エラーの場合は変わっていないかどうか
		if ($expectedSaveResult) {
			$this->_assertGroupData($dbData, $inputData, $expectedSaveResult);
		} else {
			$this->_assertGroupData($dbData, $this->__getFixtureData(), $expectedSaveResult);
		}
	}

/**
 * testEditPost用dataProvider
 *
 * ### 戻り値
 *  - rest : REST
 *  - inputData:	入力データ
 *  - expectedSaveResult:	セーブ結果
 */
	public function dataProviderEditPost() {
		return array(
			array(
				'rest' => 'put',
				'inputData' => [
					'Group' => [
						'id' => 1,
						'name' => 'test1',
					],
					'GroupsUser' => [['user_id' => '1'], ['user_id' => '2']],
					'_user' => ['redirect' => 'users/users/view/1#/user-groups']
				],
				'expectedSaveResult' => true,
			),
			array(
				'rest' => 'put',
				'inputData' => [
					'Group' => [
						'id' => 1,
						'name' => 'test2',
					],
					'GroupsUser' => [['user_id' => '3'], ['user_id' => '1']],
					'_user' => ['redirect' => 'users/users/view/1#/user-groups']
				],
				'expectedSaveResult' => true,
			),
			array(
				'rest' => 'put',
				'inputData' => [
					'Group' => [
						'id' => 1,
						'name' => 'test3',
					],
					'_user' => ['redirect' => 'users/users/view/1#/user-groups'],
				],
				'expectedSaveResult' => false,
				'errMessage' => 'ユーザを選択してください。',
			),
			array(
				'rest' => 'post',
				'inputData' => [
					'Group' => [
						'id' => 1,
					],
					'GroupsUser' => [['user_id' => '1']],
					'_user' => ['redirect' => 'users/users/view/1#/user-groups']
				],
				'expectedSaveResult' => false,
				'errMessage' => 'グループ名を入力してください。',
			),
			array(
				'rest' => 'post',
				'inputData' => [
					'Group' => [
						'id' => 1,
						'name' => '',
					],
					'GroupsUser' => [['user_id' => '1'], ['user_id' => '3'], ['user_id' => '4'], ['user_id' => '2'], ['user_id' => '5']],
					'_user' => ['redirect' => 'users/users/view/1#/user-groups']
				],
				'expectedSaveResult' => false,
				'errMessage' => 'グループ名を入力してください。',
			),
			array(
				'rest' => 'post',
				'inputData' => [
					'Group' => [
						'id' => 1,
						'name' => 'test5',
					],
					'GroupsUser' => [['user_id' => '4']],
					'_user' => ['redirect' => 'users/users/view/1#/user-groups']
				],
				'expectedSaveResult' => true,
			),
		);
	}

/**
 * edit()アクションのCancelリクエストテスト
 *
 * @return void
 */
	public function testEditCancel() {
		//ログイン
		TestAuthGeneral::login($this);

		//データ登録
		$this->_testPostAction(
			'put',
			array(
				'cancel' => null,
				'Group' => [
					'id' => 1,
					'name' => 'test1',
				],
				'GroupsUser' => [['user_id' => '1'], ['user_id' => '2']],
				'_user' => ['redirect' => 'users/users/view/1#/user-groups']
			),
			array('action' => 'edit', 1),
			null,
			'view'
		);

		//表示ページ確認
		$this->_assertRedirect(true);
	}

/**
 * フィクスチャに入っているデータを返す
 *
 * @return array
 */
	private function __getFixtureData() {
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
}
