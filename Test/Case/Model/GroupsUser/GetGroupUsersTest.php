<?php
/**
 * GroupsUser::getGroupUsers()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Yuna Miyashita <butackle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('GroupsControllerTestCase', 'Groups.Test/Case');

/**
 * GroupsUser::getGroupUsers()のテスト
 *
 * @author Yuna Miyashita <butackle@gmail.com>
 * @package NetCommons\Groups\Test\Case\Model\GroupsUser
 */
class GroupsUsergetGroupUsersTest extends GroupsControllerTestCase {

/**
 * getGroupUsers()のテスト
 *
 * @dataProvider dataProvidergetGroupUsers
 * @param array $inputData 入力データ
 * @return void
 */
	public function testGetGroupUsers($inputData = []) {
		$result = $this->_classGroupsUser->getGroupUsers($inputData);

		if (empty($inputData)) {
			$this->assertEquals(
				array(), $result
			);
			return;
		}
	}

/**
 * testGetGroupUsers用dataProvider
 * 
 * ### 戻り値
 *  - inputData:	入力データ
 *  - saveResult:	セーブ結果
 */
	public function dataProviderGetGroupUsers() {
		return array(
			array([]),
			array([1]),
			array([1, 2]),
			array([2, 1]),
			array([1, 999999]),
			array([5616516516, 1651651651])
		);
	}

}
