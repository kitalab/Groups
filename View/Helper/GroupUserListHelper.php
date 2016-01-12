<?php
/**
 * GroupUserList Helper
 *
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2015, NetCommons Project
 */

App::uses('AppHelper', 'View/Helper');

/**
 * UserSearch Helper
 *
 * @package NetCommons\Users\View\Helper
 */
class GroupUserListHelper extends AppHelper {

/**
 * 使用するヘルパー
 * ただし、Roomヘルパーを使用する場合は、RoomComponentを呼び出している必要がある。
 *
 * @var array
 */
	public $helpers = array(
		'NetCommons.NetCommonsHtml',
		'NetCommons.Date',
		'Rooms.Rooms',
		'Users.UserSearch'
	);

/**
 * UserAttributes data
 *
 * @var array
 */
	public $userAttributes;

/**
 * Default Constructor
 *
 * @param View $View The View this helper is being attached to.
 * @param array $settings Configuration settings for the helper.
 */
	public function __construct(View $View, $settings = array()) {
		parent::__construct($View, $settings);
	}

/**
 * ユーザ選択画面でJSONでユーザを表示する
 *
 * @param array $groups グループ一覧データ
 * @return array JSON変換用配列
 */
	public function convertGroupUserListForDisplay($groups) {
		$result = array();
		foreach ($groups as $group) {
			$groupsUsers = array();
			if (!empty($group['GroupsUser'])) {
				foreach ($group['GroupsUser'] as $groupsUser) {
					$groupsUsers[] = $this->UserSearch->convertUserArrayByUserSelection($groupsUser, 'User');
				}
			}
			$result[] = array_merge_recursive($group['Group'], array('groupsUser' => $groupsUsers));
		}
		return $result;
	}
}
