<?php
/**
 * GroupsController::select()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Yuna Miyashita <butackle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('GroupsControllerTestCase', 'Groups.Test/Case/Controller');

/**
 * GroupsController::select()のテスト
 *
 * @author Yuna Miyashita <butackle@gmail.com>
 * @package NetCommons\Groups\Test\Case\Controller\GroupsController
 */
class GroupsControllerSelectTest extends GroupsControllerTestCase {

/**
 * select()アクションのGetリクエストテスト
 *
 * @return void
 */
	public function testSelectGet() {
		//テスト実行
		$this->_testGetAction(
			array('action' => 'select'),
			array('method' => 'assertNotEmpty'),
			null,
			'view'
		);
	}

}
