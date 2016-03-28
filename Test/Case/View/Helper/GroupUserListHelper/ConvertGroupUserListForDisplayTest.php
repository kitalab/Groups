<?php
/**
 * GroupUserListHelper::convertGroupUserListForDisplay()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Yuna Miyashita <butackle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('GroupsViewTestBase', 'Groups.Test/Case');

/**
 * GroupUserListHelper::convertGroupUserListForDisplay()のテスト
 *
 * @author Yuna Miyashita <butackle@gmail.com>
 * @package NetCommons\Groups\Test\Case\View\Helper\GroupUserListHelper
 */
class GroupUserListHelperConvertGroupUserListForDisplayTest extends GroupsViewTestBase {

/**
 * convertGroupUserListForDisplay()のテスト
 *
 * @param array $groupUsers
 * @return void
 */
	public function testConvertGroupUserListForDisplay($groupUsers = []) {
		$groupUsers = [
				['User' => ['id' => 1]],
				['User' => ['id' => 2]],
				['User' => ['id' => 3]],
				['User' => ['id' => 1]],
				['User' => ['name' => 3]],
			];
		$view = $this->_createViewClass();
		$view->GroupUserList->convertGroupUserListForDisplay($groupUsers);
	}

}
