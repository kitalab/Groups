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
		$this->__group->deleteAll(true);
		//モーダルウィンドウで登録に成功する場合はモーダルが閉じるので設定する必要はないのだが、テストでエラーが出るため対処
		if ($expectedSaveResult && $isModal) {
			$this->controller->viewVars['isModal'] = null;
		}
		//データ登録
		$this->__group->data['Group'] = array();
		try {
			$this->_testPostAction(
				'post',
				$inputData,
				array('action' => 'add', $isModal),
				null,
				'view'
			);
		} catch(exception $e){
			$this->_assertException($e);
		}
		$dbData = $this->__group->find('all');

		//登録データ数を確認
		$expectedCount = $expectedSaveResult ? 1 : 0;
		$this->assertCount($expectedCount, $dbData);
		//登録データが無い場合にはテスト終了
		if (!$expectedSaveResult) {
			return;
		}
		//登録データ内容の確認
		$this->_assertGroupData($dbData, $inputData, $expectedSaveResult);
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
