<?php
/**
 * GroupsUser::saveGroupUser()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Yuna Miyashita <butackle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('GroupsModelTestBase', 'Groups.Test/Case');

/**
 * GroupsUser::saveGroupUser()のテスト
 *
 * @author Yuna Miyashita <butackle@gmail.com>
 * @package NetCommons\Groups\Test\Case\Model\GroupsUser
 */
class GroupsUserSaveGroupUserTest extends GroupsModelTestBase {

/**
 * saveGroupUser()のテスト
 *
 * @dataProvider dataProviderSaveGroupUser
 * @param array $inputData 入力データ
 * @param bool saveResult セーブ結果
 * @return void
 */
	public function testSaveGroupUser($inputData = [], $saveResult = 1) {
		$this->assertTrue(
			$this->_classGroupsUser->saveGroupUser($inputData) === $saveResult, 'セーブ結果が想定と異なります。'
		);

		$expectedCount = $saveResult ? 2 : 1;
		$this->assertEqual(
			$expectedCount,
			$this->_groupsUser->find('count'),
			'データ登録数が想定と異なります。'
		);
	}

/**
 * testSaveGroupUser用dataProvider
 * 
 * ### 戻り値
 *  - inputData:	入力データ
 *  - saveResult:	セーブ結果
 */
	public function dataProviderSaveGroupUser() {
		return array(
			//登録可能
			array(
				[
						'user_id' => '3',
						'group_id' => '1'
				],
				true
			),
			//登録可能
			array(
				[
					'user_id' => '4',
					'group_id' => '1'
				],
				true
			),
			//NULL
			array(
				[],
				false
			),
			//グループIDなし
			array(
				[
					'user_id' => '4',
				],
				false
			),
			//ユーザIDなし
			array(
				[
					'group_id' => '1'
				],
				false
			),
			//存在しないグループID
			array(
				[
					'user_id' => '1',
					'group_id' => '2'
				],
				false
			),
			//存在しないユーザID
			array(
				[
					'user_id' => '999999999',
					'group_id' => '2'
				],
				false
			),
		);
	}

}
