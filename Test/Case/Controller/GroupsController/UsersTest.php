<?php
/**
 * GroupsController::users()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Yuna Miyashita <butackle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('GroupsControllerTestCase', 'Groups.Test/Case/Controller');

/**
 * GroupsController::users()のテスト
 *
 * @author Yuna Miyashita <butackle@gmail.com>
 * @package NetCommons\Groups\Test\Case\Controller\GroupsController
 */
class GroupsControllerUsersTest extends GroupsControllerTestCase {

/**
 * users()アクションのGetリクエストテスト
 *
 * @return void
 */
	public function testUsersGet() {
		//テスト実行
		$this->_testGetAction(
			array('action' => 'users'),
			array('method' => 'assertNotEmpty'),
			null,
			'view'
		);
	}

}
