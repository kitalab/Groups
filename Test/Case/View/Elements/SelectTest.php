<?php
/**
 * View/Elements/selectのテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Yuna Miyashita <butackle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('GroupsControllerTestCase', 'Groups.Test/Case');

/**
 * View/Elements/selectのテスト
 *
 * @author Yuna Miyashita <butackle@gmail.com>
 * @package NetCommons\Groups\Test\Case\View\Elements\Select
 */
class GroupsViewElementsSelectTest extends GroupsControllerTestCase {

/**
 * View/Elements/selectのテスト
 *
 * @return void
 */
	public function testSelect() {
		//テスト実行
		$this->_testGetAction('/test_groups/test_view_elements_select/select',
				array('method' => 'assertNotEmpty'), null, 'view');

		//チェック
		$pattern = '/' . preg_quote('View/Elements/select', '/') . '/';
		$this->assertRegExp($pattern, $this->view);

		//SHOULD:必要に応じてassert追加する
		debug($this->view);
	}

}
