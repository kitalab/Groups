<?php
/**
 * GroupUserList Helper
 *
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
<<<<<<< HEAD
 * @copyright Copyright 2015, NetCommons Project
=======
 * @copyright Copyright 2016, NetCommons Project
>>>>>>> 5add7ac49e11c80f097e28a0be820b23d7b6d92b
 */

App::uses('AppHelper', 'View/Helper');

/**
<<<<<<< HEAD
 * UserSearch Helper
 *
 * @package NetCommons\Users\View\Helper
=======
 * GroupUserList Helper
 *
 * @package NetCommons\Groups\View\Helper
>>>>>>> 5add7ac49e11c80f097e28a0be820b23d7b6d92b
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
<<<<<<< HEAD
 * ユーザ選択画面でJSONでユーザを表示する
=======
 * ユーザ選択画面でJSON形式でユーザを表示する
>>>>>>> 5add7ac49e11c80f097e28a0be820b23d7b6d92b
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
