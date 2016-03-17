<?php
/**
 * View/Elements/edit_formのテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Yuna Miyashita <butackle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('GroupsControllerTestCase', 'Groups.Test/Case');

/**
 * View/Elements/edit_formのテスト
 *
 * @author Yuna Miyashita <butackle@gmail.com>
 * @package NetCommons\Groups\Test\Case\View\Elements\EditForm
 */
class GroupsViewElementsEditFormTest extends GroupsControllerTestCase {

/**
 * View/Elements/edit_formのテスト
 *
 * @return void
 */
	public function testEditForm() {
		//テスト実行
		$this->_testGetAction('/test_groups/test_view_elements_edit_form/edit_form',
				array('method' => 'assertNotEmpty'), null, 'view');

		//チェック
		$pattern = '/' . preg_quote('View/Elements/edit_form', '/') . '/';
		$this->assertRegExp($pattern, $this->view);

		//SHOULD:必要に応じてassert追加する
		debug($this->view);
	}

}
