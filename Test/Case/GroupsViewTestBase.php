<?php
/**
 * Groups Viewのテストケース
 *
 * @author Yuna Miyashita <butackle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('GroupsTestBase', 'Groups.Test/Case');


/**
 * Groups Viewのテストケース
 *
 * @author Yuna Miyashita <butackle@gmail.com>
 * @package NetCommons\Groups\Test\Case\Controller
 */
class GroupsViewTestBase extends GroupsTestBase {

/**
 * elementの表示を取得
 *
 * @param string $path elementのパス
 * @param array $data Elementの変数
 * @param array $requestData リクエストdata
 * @return string 表示文字列
 */
	protected function _makeElementView($path, $data = [], $requestData = []) {
			$view = $this->_createViewClass($requestData);
			return $view->element($path, $data);
	}

/**
 * テストに使うViewクラスを作成
 * 
 * @param array $requestData リクエストdata
 * @return object Viewクラス
 */
	protected function _createViewClass($requestData = []) {
		$this->controller->set('userAttributes', []);
		$this->controller->request->data = $requestData;
		$View = new View($this->controller);
		$View->Room = new Room();
		$View->plugin = Inflector::camelize($this->plugin);
		$View->helpers = $this->controller->helpers;
		$View->loadHelpers();
		return $View;
	}
}
