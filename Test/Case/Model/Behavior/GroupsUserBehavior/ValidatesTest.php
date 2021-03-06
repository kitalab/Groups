<?php
/**
 * GroupsUserBehavior::validates()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Yuna Miyashita <butackle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('GroupsModelTestBase', 'Groups.Test/Case');
App::uses('GroupsUserBehavior', 'Groups.Model/Behavior');

/**
 * GroupsUserBehavior::validates()のテスト
 *
 * @author Yuna Miyashita <butackle@gmail.com>
 * @package NetCommons\Groups\Test\Case\Model\Behavior\GroupsUserBehavior
 */
class GroupsUserBehaviorValidatesTest extends GroupsModelTestBase {

/**
 * validates()のテスト
 *
 * @dataProvider dataProviderValidates
 * @param array $inputData 入力データ
 * @param array $validationErrors バリデーション結果
 * @return void
 */
	public function testValidates($inputData = [], $validationErrors = []) {
		$behaviorGroupsUser = new GroupsUserBehavior();
		$this->_group->set($inputData);
		$behaviorGroupsUser->beforeValidate($this->_group, []);

		$this->assertEquals(
			$validationErrors,
			$this->_group->validationErrors,
			"バリデーション結果が違います"
		);
	}
}
