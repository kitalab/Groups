<?php
/**
 * GroupUserListHelper::convertGroupUserListForDisplay()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsHelperTestCase', 'NetCommons.TestSuite');

/**
 * GroupUserListHelper::convertGroupUserListForDisplay()のテスト
 *
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
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
		$groupUsers = array(
			0 => array(
				'User' => array(
					'id' => '1',
				)
			)
		);

		//テスト実施
		$result = $this->GroupUserList->convertGroupUserListForDisplay($groupUsers);

		//チェック
		$this->assertNotEmpty($result);
	}

/**
 * convertGroupUserListForDisplay() IDが設定されていない場合のテスト
 *
 * @return void
 */
	public function testConvertGroupUserListForDisplayIdIsNotSet() {
		//データ生成
		$groupUsers = array(
			0 => array(
				'User' => array()
			)
		);

		//テスト実施
		$result = $this->GroupUserList->convertGroupUserListForDisplay($groupUsers);

		//チェック
		$this->assertEmpty($result);
	}

/**
 * convertGroupUserListForDisplay() Nullのテスト
 *
 * @return void
 */
	public function testConvertGroupUserListForDisplayNull() {
		//データ生成
		$groupUsers = array();

		//テスト実施
		$result = $this->GroupUserList->convertGroupUserListForDisplay($groupUsers);

		//チェック
		$this->assertEmpty($result);
	}
}
