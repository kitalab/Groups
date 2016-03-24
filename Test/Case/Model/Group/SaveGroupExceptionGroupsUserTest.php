<?php
/**
 * Group::saveGroup()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Yuna Miyashita <butackle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('GroupsControllerTestCase', 'Groups.Test/Case');

/**
 * Group::saveGroup()のテスト
 *
 * @author Yuna Miyashita <butackle@gmail.com>
 * @package NetCommons\Groups\Test\Case\Model\Group
 */
class GroupSaveGroupExceptionGroupsUserTest extends GroupsControllerTestCase {

/**
 * saveGroup()のExceptionテスト
 *
 * @dataProvider dataProviderSaveGroup
 * @param array $inputData 入力データ
 * @return void
 */
	public function testSaveGroup($inputData = []) {
		//$this->setExpectedException('InternalErrorException');
		$this->_classGroup->saveGroup($inputData);

		//$this->assertCount(
		//	1,
		//	$this->_groups->find()
		//);
		//$this->assertCount(
		//	1,
		//	$this->_groupsUser->find()
		//);
	}

/**
 * testSaveGroup用dataProvider
 * 
 * ### 戻り値
 *  - inputData:	入力データ
 */
	public function dataProviderSaveGroup() {
		return array(
			array(
				[
					'Group' => [
						'name' => 'TestInsert',
					],
					'GroupsUser' => [
						['user_id' => '1']
					]
				],
			),
			array(
				[
					'Group' => [
						'id' => 1,
						'name' => 'TestUpdate',
					],
					'GroupsUser' => [
						['user_id' => '1']
					]
				],
			),
		);
	}
}
