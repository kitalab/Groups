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

App::uses('NetCommonsHelperTestCase', 'NetCommons.TestSuite');

/**
 * GroupUserListHelper::convertGroupUserListForDisplay()のテスト
 *
 * @author Yuna Miyashita <butackle@gmail.com>
 * @package NetCommons\Groups\Test\Case\View\Helper\GroupUserListHelper
 */
class GroupUserListHelperConvertGroupUserListForDisplayTest extends NetCommonsHelperTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array();

/**
 * Plugin name
 *
 * @var string
 */
	public $plugin = 'groups';

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		//テストデータ生成
		//SHOULD:必要に応じてセットする
		$viewVars = array();
		$requestData = array();
		$params = array();

		//Helperロード
		$this->loadHelper('Groups.GroupUserList', $viewVars, $requestData, $params);
	}

/**
 * convertGroupUserListForDisplay()のテスト
 *
 * @return void
 */
	public function testConvertGroupUserListForDisplay() {
		//データ生成
		$groupUsers = null;

		//テスト実施
		$result = $this->GroupUserList->convertGroupUserListForDisplay($groupUsers);

		//チェック
		//SHOULD:assertを書く
		debug($result);
	}

}
