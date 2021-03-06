<?php
/**
 * View/Elements/select_groupsのテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Yuna Miyashita <butackle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('GroupsViewTestBase', 'Groups.Test/Case');

/**
 * View/Elements/select_groupsのテスト
 *
 * @author Yuna Miyashita <butackle@gmail.com>
 * @package NetCommons\Groups\Test\Case\View\Elements\SelectGroups
 */
class GroupsViewElementsSelectGroupsTest extends GroupsViewTestBase {

/**
 * View/Elements/select_groupsのテスト
 *
 * @dataProvider dataProviderSelectGroups
 * @param string $groupType
 * @return void
 */
	public function testSelectGroups($groupType = 'groupList') {
		$this->_makeElementView(
			'Groups.select_groups',
			[
				'groupType' => $groupType
			]
		);
	}

/**
 * testSelectGroups用dataProvider
 * 
 * ### 戻り値
 *  - groupType:	groupType
 */
	public function dataProviderSelectGroups() {
		return array(
			['groupList'], ['selectors']
		);
	}

}
