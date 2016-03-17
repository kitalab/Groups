<?php
/**
 * View/Elements/select_usersのテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Yuna Miyashita <butackle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('GroupsControllerTestCase', 'Groups.Test/Case');

/**
 * View/Elements/select_usersのテスト
 *
 * @author Yuna Miyashita <butackle@gmail.com>
 * @package NetCommons\Groups\Test\Case\View\Elements\SelectUsers
 */
class GroupsViewElementsSelectUsersTest extends GroupsControllerTestCase {

/**
 * View/Elements/select_usersのテスト
 *
 * @return void
 */
	public function testSelectUsers() {
		//テスト実行
		$this->_testGetAction('/test_groups/test_view_elements_select_users/select_users',
				array('method' => 'assertNotEmpty'), null, 'view');

		//チェック
		$pattern = '/' . preg_quote('View/Elements/select_users', '/') . '/';
		$this->assertRegExp($pattern, $this->view);

		//SHOULD:必要に応じてassert追加する
		debug($this->view);
	}

}
