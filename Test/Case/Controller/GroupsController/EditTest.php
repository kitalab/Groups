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

App::uses('GroupsControllerTestCase', 'Groups.Test/Case/Controller');

/**
 * GroupsController::edit()のテスト
 *
 * @author Yuna Miyashita <butackle@gmail.com>
 * @package NetCommons\Groups\Test\Case\Controller\GroupsController
 */
class GroupsControllerEditTest extends GroupsControllerTestCase {

/**
 * edit()アクションのGetリクエストテスト
 *
 * @dataProvider dataProviderEditGet
 * @param $id ID
 * @param $exception	想定されるエラー
 * @return void
 */
	public function testEditGet($id, $exception) {
		//テスト実行
		$this->_testGetAction(
			array('action' => 'edit', $id),
			array('method' => 'assertNotEmpty'),
			$exception,
			'view'
		);
	}

/**
 * testEditGet用dataProvider
 * 
 * ### 戻り値
 *  - id : ID
 *  - exception:	想定されるエラー
 */
	public function dataProviderEditGet() {
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

/**
 * edit()アクションのPostリクエストテスト
 *
 * @dataProvider dataProviderEditPost
 * @param $rest REST
 * @param $inputData	入力するデータ
 * @param $expectedSaveResult	セーブ結果(想定)
 * @return void
 */
	public function testEditPost($rest = 'post', $inputData = [], $expectedSaveResult = 1) {
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
		$dbData = $this->__group->find('all');

		//登録データ数を確認
		$this->assertCount(1, $dbData);
		//データが編集されている場合には変わっているかどうか。編集エラーの場合は変わっていないかどうか
		if ($expectedSaveResult) {
			$this->_assertGroupData($dbData, $inputData, $expectedSaveResult);
		} else {
			$this->_assertGroupData($dbData, $this->_getFixtureData(), $expectedSaveResult);
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
					'GroupsUser' => [['user_id' => '1'], ['user_id' => '2']]
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
					'GroupsUser' => [['user_id' => '3'], ['user_id' => '1']]
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
				],
				'expectedSaveResult' => false,
			),
			array(
				'rest' => 'post',
				'inputData' => [
					'Group' => [
						'id' => 1,
					],
					'GroupsUser' => [['user_id' => '1']]
				],
				'expectedSaveResult' => false,
			),
			array(
				'rest' => 'post',
				'inputData' => [
					'Group' => [
						'id' => 1,
						'name' => '',
					],
					'GroupsUser' => [['user_id' => '1'], ['user_id' => '3'], ['user_id' => '4'], ['user_id' => '2'], ['user_id' => '5']]
				],
				'expectedSaveResult' => false,
			),
			array(
				'rest' => 'post',
				'inputData' => [
					'Group' => [
						'id' => 1,
						'name' => 'test5',
					],
					'GroupsUser' => [['user_id' => '4']]
				],
				'expectedSaveResult' => true,
			),
		);
	}
}
