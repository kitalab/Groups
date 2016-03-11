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

App::uses('GroupsControllerTestCase', 'Groups.Test/Case/Controller');

/**
 * GroupsController::add()のテスト
 *
 * @author Yuna Miyashita <butackle@gmail.com>
 * @package NetCommons\Groups\Test\Case\Controller\GroupsController
 */
class GroupsControllerAddTest extends GroupsControllerTestCase {

/**
 * add()アクションのPostリクエストテスト
 *
 * @dataProvider dataProviderAddPost
 * @param $isModal	モーダル表示の有無
 * @param $inputData	入力するデータ
 * @param $expectedSaveResult	セーブ結果(想定)
 * @return void
 */
	public function testAddPost($isModal = null, $inputData = [], $expectedSaveResult = 1) {
		//データを全削除
		$this->controller->Group->deleteAll(true);
		//データ登録
		$isError = true;
		$errMessage = '';
		try {
			$this->_testPostAction(
				'post',
				$inputData,
				array('action' => 'add', $isModal),
				null,
				'view'
			);
			$isError = false;
		} catch(exception $e){
			$errMessage .= "Error:" . $e->getCode() . "　" . $e->getMessage() . "\r\n";
			$errMessage .= $e->getFile() . "  Line:" . $e->getLine() . "\r\n";
			//$errMessage .= "\r\n".$e->getTraceAsString()."\r\n";
		}
		$this->assertFalse($isError, $errMessage);
		$allData = $this->controller->Group->find('all');

		//登録データ数を確認
		$expectedCount = $expectedSaveResult ? 1 : 0;
		$this->assertCount($expectedCount, $allData);
		//登録データが無い場合にはテスト終了
		if (!$expectedSaveResult) {
			return;
		}
		//登録データ内容の確認
		$this->__assertGroupData($allData, $inputData, $expectedSaveResult);
	}

/**
 * 登録データ内容の確認
 *
 * @param $allData	DBから取得したデータ
 * @param $inputData	入力したデータ
 * @param $expectedSaveResult	セーブ結果(想定)
 * @return void
 */
	private function __assertGroupData($allData, $inputData, $expectedSaveResult) {
		$inputGroupUserData = isset($inputData['GroupsUser']) ? $inputData['GroupsUser'] : null;
		//登録データ詳細を取得
		$saveGroupsData = $allData[0]['Group'];
		$saveGroupsUserData = $allData[0]['GroupsUser'];
		//登録したユーザ数を確認
		$expectedGroupUserCnt = $expectedSaveResult ? count($inputGroupUserData) : 0;
		$this->assertCount($expectedGroupUserCnt, $saveGroupsUserData);
		//グループ名が正しく登録されているかを確認
		$expectedUserName = $inputData['name'];
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
 * testAddPost用dataProvider
 * 
 * ### 戻り値
 *  - isModal:	モーダル表示の有無
 *  - inputData:	入力データ
 *  - expectedSaveResult:	セーブ結果
 */
	public function dataProviderAddPost() {
		return array(
			array(
				'isModal' => false,
				'inputData' => [
					'name' => 'test1',
					'GroupsUser' => [['user_id' => '1'], ['user_id' => '2']]
				],
				'expectedSaveResult' => true,
			),
			array(
				'isModal' => false,
				'inputData' => [
					'name' => 'test2',
					'GroupsUser' => [['user_id' => '3'], ['user_id' => '1']]
				],
				'expectedSaveResult' => true,
			),
			array(
				'isModal' => false,
				'inputData' => [
					'name' => 'test3',
				],
				'expectedSaveResult' => false,
			),
			array(
				'isModal' => false,
				'inputData' => [
					'GroupsUser' => [['user_id' => '1']]
				],
				'expectedSaveResult' => false,
			),
			array(
				'isModal' => true,
				'inputData' => [
					'name' => '',
					'GroupsUser' => [['user_id' => '1'], ['user_id' => '3'], ['user_id' => '4'], ['user_id' => '2'], ['user_id' => '5']]
				],
				'expectedSaveResult' => false,
			),
			array(
				'isModal' => true,
				'inputData' => [
					'name' => 'test5',
					'GroupsUser' => [['user_id' => '4']]
				],
				'expectedSaveResult' => true,
			),
		);
	}

}
