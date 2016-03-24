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
class GroupSaveGroupExceptionGroupTest extends GroupsControllerTestCase {

/**
 * Fixtures Setting
 *
 * @param string $name
 * @param array $data
 * @param string $dataName
 * @var array
 */
	public function __construct($name = null, array $data = array(), $dataName = '') {
		unset($this->fixtures['Group']);
		$this->fixtures[] = 'plugin.groups.group_exception';

		parent::__construct($name, $data, $dataName);
	}

/**
 * saveGroup()のExceptionテスト
 *
 * @return void
 */
	public function testSaveGroup() {
		$this->setExpectedException('InternalErrorException');
		$this->_classGroup->saveGroup(array(
			'Group' => [
				'name' => 'TestInsert',
			],
			'GroupsUser' => [
				['user_id' => '1'], ['user_id' => '3']
			]
		));

		$this->assertCount(
			1,
			$this->_groups->find()
		);
		$this->assertCount(
			1,
			$this->_groupsUser->find()
		);
	}

}
