<?php
/**
 * [WeEngine System] Copyright (c) 2014 W7.CC
 * $sn$
 */
defined('IN_IA') or exit('Access Denied');

/**
 * 平台所有账号类型附属信息(根据type_sign即账号标识分类)
 * @param string $type_sign 账号标识
 * @return array|mixed
 */
function uni_account_type_sign($type_sign = '') {
	$all_account_type_sign = array(
		ACCOUNT_TYPE_SIGN => array(
			'contain_type' => array(ACCOUNT_TYPE_OFFCIAL_NORMAL, ACCOUNT_TYPE_OFFCIAL_AUTH),
			'level' => array(ACCOUNT_SUBSCRIPTION => '订阅号', ACCOUNT_SERVICE => '服务号', ACCOUNT_SUBSCRIPTION_VERIFY => '认证订阅号', ACCOUNT_SERVICE_VERIFY => '认证服务号'),
			'jointype' => array(ACCOUNT_TYPE_OFFCIAL_NORMAL => '普通接入', ACCOUNT_TYPE_OFFCIAL_AUTH => '授权接入'),
			'icon' => 'wi wi-wx-circle',
			'createurl' => url('account/post-step'),
			'title' => '公众号',
		),
		WXAPP_TYPE_SIGN => array(
			'contain_type' => array(ACCOUNT_TYPE_APP_NORMAL, ACCOUNT_TYPE_APP_AUTH),
			'level' => array(),
			'jointype' => array(ACCOUNT_TYPE_APP_NORMAL => '普通接入', ACCOUNT_TYPE_APP_AUTH => '授权接入'),
			'icon' => 'wi wi-wxapp',
			'createurl' => url('wxapp/post/design_method'),
			'title' => '微信小程序',
		),
		WEBAPP_TYPE_SIGN => array(
			'contain_type' => array(ACCOUNT_TYPE_WEBAPP_NORMAL),
			'level' => array(),
			'icon' => 'wi wi-pc-circle',
			'createurl' => url('account/create', array('sign' => 'webapp')),
			'title' => 'PC',
		),
		PHONEAPP_TYPE_SIGN => array(
			'contain_type' => array(ACCOUNT_TYPE_PHONEAPP_NORMAL),
			'level' => array(),
			'icon' => 'wi wi-app',
			'createurl' => url('account/create', array('sign' => 'phoneapp')),
			'title' => 'APP',
		),
		ALIAPP_TYPE_SIGN => array(
			'contain_type' => array(ACCOUNT_TYPE_ALIAPP_NORMAL),
			'level' => array(),
			'icon' => 'wi wi-aliapp',
			'createurl' => url('account/create', array('sign' => 'aliapp')),
			'title' => '支付宝小程序',
		),
		BAIDUAPP_TYPE_SIGN => array(
			'contain_type' => array(ACCOUNT_TYPE_BAIDUAPP_NORMAL),
			'level' => array(),
			'icon' => 'wi wi-baiduapp',
			'createurl' => url('account/create', array('sign' => 'baiduapp')),
			'title' => '百度小程序',
		),
		TOUTIAOAPP_TYPE_SIGN => array(
			'contain_type' => array(ACCOUNT_TYPE_TOUTIAOAPP_NORMAL),
			'level' => array(),
			'icon' => 'wi wi-toutiaoapp',
			'createurl' => url('account/create', array('sign' => 'toutiaoapp')),
			'title' => '字节跳动小程序',
		),
	);
	if (!empty($type_sign)) {
		return !empty($all_account_type_sign[$type_sign]) ? $all_account_type_sign[$type_sign] : array();
	}
	return $all_account_type_sign;
}

/**
 * 平台所有账号类型附属信息(根据type即账号类型分类)
 * @param int $type 账号类型
 * @return array|mixed
 */
function uni_account_type($type = 0) {
	$all_account_type = array(
		ACCOUNT_TYPE_OFFCIAL_NORMAL => array(
			'title' => '公众号',
			'type_sign' => ACCOUNT_TYPE_SIGN,
			'table_name' => 'account_wechats',
			'module_support_name' => MODULE_SUPPORT_ACCOUNT_NAME,
			'module_support_value' => MODULE_SUPPORT_ACCOUNT,
		),
		ACCOUNT_TYPE_OFFCIAL_AUTH => array(
			'title' => '公众号',
			'type_sign' => ACCOUNT_TYPE_SIGN,
			'table_name' => 'account_wechats',
			'module_support_name' => MODULE_SUPPORT_ACCOUNT_NAME,
			'module_support_value' => MODULE_SUPPORT_ACCOUNT,
		),
		ACCOUNT_TYPE_APP_NORMAL => array(
			'title' => '微信小程序',
			'type_sign' => WXAPP_TYPE_SIGN,
			'table_name' => 'account_wxapp',
			'support_version' => 1,
			'version_tablename' => 'wxapp_versions',
			'module_support_name' => MODULE_SUPPORT_WXAPP_NAME,
			'module_support_value' => MODULE_SUPPORT_WXAPP,
		),
		ACCOUNT_TYPE_APP_AUTH => array(
			'title' => '微信小程序',
			'type_sign' => WXAPP_TYPE_SIGN,
			'table_name' => 'account_wxapp',
			'support_version' => 1,
			'version_tablename' => 'wxapp_versions',
			'module_support_name' => MODULE_SUPPORT_WXAPP_NAME,
			'module_support_value' => MODULE_SUPPORT_WXAPP,
		),
		//弄得时候再放开注释
		//ACCOUNT_TYPE_WXAPP_WORK => array(
		//	'title' => '企业小程序',
		//	'type_sign' => WXAPP_TYPE_SIGN,
		//	'table_name' => 'account_wxapp',
		//	'support_version' => 1,
		//	'version_tablename' => 'wxapp_versions',
		//	'module_support_name' => MODULE_SUPPORT_WXAPP_NAME,
		//	'module_support_value' => MODULE_SUPPORT_WXAPP,
		//),
		ACCOUNT_TYPE_WEBAPP_NORMAL => array(
			'title' => 'PC',
			'type_sign' => WEBAPP_TYPE_SIGN,
			'table_name' => 'account_webapp',
			'module_support_name' => MODULE_SUPPORT_WEBAPP_NAME,
			'module_support_value' => MODULE_SUPPORT_WEBAPP,
		),
		ACCOUNT_TYPE_PHONEAPP_NORMAL => array(
			'title' => 'APP',
			'type_sign' => PHONEAPP_TYPE_SIGN,
			'table_name' => 'account_phoneapp',
			'support_version' => 1,
			'version_tablename' => 'wxapp_versions',
			'module_support_name' => MODULE_SUPPORT_PHONEAPP_NAME,
			'module_support_value' => MODULE_SUPPORT_PHONEAPP,
		),
		ACCOUNT_TYPE_ALIAPP_NORMAL => array(
			'title' => '支付宝小程序',
			'type_sign' => ALIAPP_TYPE_SIGN,
			'table_name' => 'account_aliapp',
			'support_version' => 1,
			'version_tablename' => 'wxapp_versions',
			'module_support_name' => MODULE_SUPPORT_ALIAPP_NAME,
			'module_support_value' => MODULE_SUPPORT_ALIAPP,
		),
		ACCOUNT_TYPE_BAIDUAPP_NORMAL => array(
			'title' => '百度小程序',
			'type_sign' => BAIDUAPP_TYPE_SIGN,
			'table_name' => 'account_baiduapp',
			'support_version' => 1,
			'version_tablename' => 'wxapp_versions',
			'module_support_name' => MODULE_SUPPORT_BAIDUAPP_NAME,
			'module_support_value' => MODULE_SUPPORT_BAIDUAPP,
		),
		ACCOUNT_TYPE_TOUTIAOAPP_NORMAL => array(
			'title' => '字节跳动小程序',
			'type_sign' => TOUTIAOAPP_TYPE_SIGN,
			'table_name' => 'account_toutiaoapp',
			'support_version' => 1,
			'version_tablename' => 'wxapp_versions',
			'module_support_name' => MODULE_SUPPORT_TOUTIAOAPP_NAME,
			'module_support_value' => MODULE_SUPPORT_TOUTIAOAPP,
		),
	);
	if (!empty($type)) {
		return !empty($all_account_type[$type]) ? $all_account_type[$type] : array();
	}
	return $all_account_type;
}

/**
 * 是否加载account数据(即$_W['account'])
 * @return bool
 */
function uni_need_account_info() {
	global $controller, $action, $do, $_GPC;
	$module_name = empty($_GPC['module_name']) ? '' : safe_gpc_string($_GPC['module_name']);
	$system_welcome = empty($_GPC['system_welcome']) ? '' : safe_gpc_string($_GPC['system_welcome']);
	$module_type = empty($_GPC['module_type']) ? '' : safe_gpc_string($_GPC['module_type']);
	if (defined('FRAME') && in_array(FRAME, array('account', 'wxapp')) && !$system_welcome && $module_type != 'system_welcome') {
		if ('site' == $controller && 'entry' == $action) {
			$eid = !empty($_GPC['eid']) ? intval($_GPC['eid']) : 0;
			if (!empty($eid)) {
				$entry = module_entry($eid);
			} else {
				$entry_module_name = $module_name ? $module_name : safe_gpc_string($_GPC['m']);
				$entry = table('modules_bindings')
					->where(array(
						'module' => $entry_module_name,
						'do' => $do
					))
					->get();
				if (empty($entry)) {
					$entry = array(
						'module' => $entry_module_name,
						'do' => safe_gpc_string($_GPC['do']),
						'state' => !empty($_GPC['state']) ? safe_gpc_string($_GPC['state']) : '',
						'direct' => !empty($_GPC['direct']) ? safe_gpc_string($_GPC['direct']) : 0,
					);
				}
			}
			if ($entry['direct']) {
				return false;
			}
		}
		return true;
	}
	if ($controller == 'miniapp') {
		if ($action == 'version' && $do == 'display') {
			return true;
		}
	}
	return false;
}

function uni_account_create_info() {
	global $_W;
	load()->model('permission');
	$account_create_info = permission_user_account_num();
	$account_all_type_sign = uni_account_type_sign();
	foreach ($account_all_type_sign as $sign => &$sign_info) {
		if ($_W['isadmin']) {
			$sign_info['can_create'] = true;
		} else {
			$sign_limit = $sign . '_limit';
			$founder_sign_limit = 'founder_' . $sign . '_limit';
			if (!empty($account_create_info[$sign_limit]) && (!empty($account_create_info[$founder_sign_limit]) && $_W['user']['owner_uid'] || empty($_W['user']['owner_uid']))) {
				$sign_info['can_create'] = true;
			} else {
				$sign_info['can_create'] = false;
			}
		}
	}
	return $account_all_type_sign;
}

/**
 * 获取account额外附加信息(账号类型/账号标题/账号标识/模块支持/账号相关表名)
 * @param $uniacid int 账号UNIACID
 * @return array
 */
function uni_account_extra_info($uniacid) {
	$uniacid = max(0, intval($uniacid));
	if (empty($uniacid)) {
		return array();
	}
	$account = pdo_get('account', array('uniacid' => $uniacid));
	if (empty($account) || empty($account['type'])) {
		return array();
	}
	$account_extra = uni_account_type($account['type']);
	return $account_extra;
}

/**
 * 获取用户可操作的所有平台账号
 * @param int $uid 要查找的用户
 * @param string $type 要查找的类型：公众号：app;小程序：wxapp;PC：webapp;
 * @return array()
 */
function uni_user_accounts($uid = 0, $type = 'account') {
	global $_W;
	$uid = intval($uid) > 0 ? intval($uid) : $_W['uid'];
	if (!in_array($type, array('account', 'wxapp', 'webapp', 'phoneapp', 'aliapp', 'baiduapp', 'toutiaoapp'))) {
		$type = 'account';
	}
	$cachekey = cache_system_key('user_accounts', array('type' => $type, 'uid' => $uid));
	$cache = cache_load($cachekey);
	if (!empty($cache)) {
		return $cache;
	}
	$type = in_array($type, array('account')) ? 'wechats' : $type;
	$select_fields = 'w.acid, w.uniacid, w.name, a.type';
	if (in_array($type, array('wechats', 'wxapp'))) {
		$select_fields .= ', w.level, w.key, w.secret, w.token';
	}
	$where = '';
	$params = array();
	if (!user_is_founder($uid, true)) {
		$select_fields .= ', u.role';
		$where .= " LEFT JOIN " . tablename('uni_account_users') . " u ON u.uniacid = w.uniacid WHERE u.uid = :uid AND u.role IN(:role1, :role2, :role3, :role4) ";
		$params[':uid'] = $uid;
		$params[':role1'] = ACCOUNT_MANAGE_NAME_OPERATOR;
		$params[':role2'] = ACCOUNT_MANAGE_NAME_MANAGER;
		$params[':role3'] = ACCOUNT_MANAGE_NAME_OWNER;
		$params[':role4'] = ACCOUNT_MANAGE_NAME_VICE_FOUNDER;
	}
	$where .= !empty($where) ? " AND a.isdeleted <> 1 AND u.role IS NOT NULL" : " WHERE a.isdeleted <> 1";

	$sql = "SELECT " . $select_fields . " FROM " . tablename('account_' . $type) . " w LEFT JOIN " . tablename('account') . " a ON a.acid = w.acid AND a.uniacid = w.uniacid" . $where;
	$result = pdo_fetchall($sql, $params, 'uniacid');
	cache_write($cachekey, $result);
	return $result;
}

/**
 * 获取某一公众号的主管理员信息
 * @param int $uniacid  指定的公众号
 * @return array
 */
function account_owner($uniacid = 0) {
	global $_W;
	load()->model('user');
	$uniacid = intval($uniacid);
	if (empty($uniacid)) {
		return array();
	}
	$ownerid = pdo_getcolumn('uni_account_users', array('uniacid' => $uniacid, 'role' => 'owner'), 'uid');
	if (empty($ownerid)) {
		$ownerid = pdo_getcolumn('uni_account_users', array('uniacid' => $uniacid, 'role' => 'vice_founder'), 'uid');
		if (empty($ownerid)) {
			$founders = explode(',', $_W['config']['setting']['founder']);
			$ownerid = $founders[0];
		}
	}
	$owner = user_single($ownerid);
	if (empty($owner)) {
		return array();
	}
	return $owner;
}
/**
 * 获取指定统一公号下默认子号的的信息
 * @param int $uniacid 公众号ID
 * @return array 当前公众号信息
 */
function uni_fetch($uniacid = 0) {
	global $_W;
	$uniacid = empty($uniacid) ? $_W['uniacid'] : intval($uniacid);
	$account_api = WeAccount::createByUniacid($uniacid);
	if (is_error($account_api)) {
		return $account_api;
	}
	$account_api->__toArray();
	$account_api['accessurl'] = $account_api['manageurl'] = wurl('account/post', array('uniacid' => $uniacid, 'account_type' => $account_api['type']), true);
	$account_api['roleurl'] = wurl('account/post-user/edit', array('uniacid' => $uniacid, 'account_type' => $account_api['type']), true);
	return $account_api;
}

/**
 * 获取指定公号下所有安装模块及模块信息
 * 公众号的权限是owner所有套餐内的全部模块权限
 * @param int $uniacid 公众号id
 * @return array 模块列表
 */
function uni_modules_by_uniacid($uniacid) {
	load()->model('user');
	load()->model('module');
	$account_info = table('account')->getByUniacid($uniacid);
	$uni_account_type = uni_account_type($account_info['type']);
	$owner_uid = pdo_getall('uni_account_users', array('uniacid' => $uniacid, 'role' => array('owner', 'vice_founder')), array('uid', 'role'), 'role');
	$owner_uid = !empty($owner_uid['owner']) ? $owner_uid['owner']['uid'] : (!empty($owner_uid['vice_founder']) ? $owner_uid['vice_founder']['uid'] : 0);

	$cachekey = cache_system_key('unimodules', array('uniacid' => $uniacid));
	$modules = cache_load($cachekey);
	if (empty($modules)) {
		$enabled_modules = table('modules')->getNonRecycleModules();
		if (!empty($owner_uid) && !user_is_founder($owner_uid, true)) {
			//设置的公众号应用权限和商城购买的应用权限
			$group_modules = table('account')->accountGroupModules($uniacid);
			//公众号owner的权限
			$user_modules = user_modules($owner_uid);
			if (!empty($user_modules)) {
				$group_modules = array_unique(array_merge($group_modules, array_keys($user_modules)));
				$group_modules = array_intersect(array_keys($enabled_modules), $group_modules);
			}
		} else {
			$group_modules = array_keys($enabled_modules);
		}
		cache_write($cachekey, $group_modules);
		$modules = $group_modules;
	}
	$modules = array_merge($modules, module_system());

	$module_list = array();
	if (!empty($modules)) {
		foreach ($modules as $name) {
			if (empty($name)) {
				continue;
			}
			$module_info = module_fetch($name);
			$module_info[$uni_account_type['module_support_name']] = empty($module_info[$uni_account_type['module_support_name']]) ? '' : $module_info[$uni_account_type['module_support_name']];
			if ($module_info[$uni_account_type['module_support_name']] != $uni_account_type['module_support_value']) {
				continue;
			}
			//将模块停用删除支持设置为不支持
			if (!empty($module_info['recycle_info'])) {
				foreach (module_support_type() as $support => $value) {
					if ($module_info['recycle_info'][$support] > 0 && $module_info[$support] == $value['support']) {
						$module_info[$support] = $value['not_support'];
					}
				}
			}
			//不支持当前account类型或仅支持系统首页的模块直接continue
			if ($module_info[MODULE_SUPPORT_ACCOUNT_NAME] != MODULE_SUPPORT_ACCOUNT &&
				in_array($account_info['type'], array(ACCOUNT_TYPE_OFFCIAL_NORMAL, ACCOUNT_TYPE_OFFCIAL_AUTH))) {
				continue;
			}
			if ($module_info[MODULE_SUPPORT_WEBAPP_NAME] != MODULE_SUPPORT_WEBAPP &&
				in_array($account_info['type'], array(ACCOUNT_TYPE_WEBAPP_NORMAL))) {
				continue;
			}
			if ($module_info[MODULE_SUPPORT_PHONEAPP_NAME] != MODULE_SUPPORT_PHONEAPP &&
				in_array($account_info['type'], array(ACCOUNT_TYPE_PHONEAPP_NORMAL))) {
				continue;
			}
			if ($module_info[MODULE_SUPPORT_ALIAPP_NAME] != MODULE_SUPPORT_ALIAPP &&
				in_array($account_info['type'], array(ACCOUNT_TYPE_ALIAPP_NORMAL))) {
				continue;
			}
			if ($module_info[MODULE_SUPPORT_BAIDUAPP_NAME] != MODULE_SUPPORT_BAIDUAPP &&
				in_array($account_info['type'], array(ACCOUNT_TYPE_BAIDUAPP_NORMAL))) {
				continue;
			}
			if ($module_info[MODULE_SUPPORT_TOUTIAOAPP_NAME] != MODULE_SUPPORT_TOUTIAOAPP &&
				in_array($account_info['type'], array(ACCOUNT_TYPE_TOUTIAOAPP_NORMAL))) {
				continue;
			}
			if ($module_info[MODULE_SUPPORT_WXAPP_NAME] != MODULE_SUPPORT_WXAPP &&
				$module_info[MODULE_SUPPORT_ACCOUNT_NAME] != MODULE_SUPPORT_ACCOUNT &&
				in_array($account_info['type'], array(ACCOUNT_TYPE_APP_NORMAL, ACCOUNT_TYPE_APP_AUTH))) {
				continue;
			}
			if ($module_info[MODULE_SUPPORT_SYSTEMWELCOME_NAME] == MODULE_SUPPORT_SYSTEMWELCOME &&
				$module_info[MODULE_SUPPORT_ACCOUNT_NAME] != MODULE_SUPPORT_ACCOUNT &&
				$module_info[MODULE_SUPPORT_WEBAPP_NAME] != MODULE_SUPPORT_WEBAPP &&
				$module_info[MODULE_SUPPORT_PHONEAPP_NAME] != MODULE_SUPPORT_PHONEAPP &&
				$module_info[MODULE_SUPPORT_ALIAPP_NAME] != MODULE_SUPPORT_ALIAPP &&
				$module_info[MODULE_SUPPORT_BAIDUAPP_NAME] != MODULE_SUPPORT_BAIDUAPP &&
				$module_info[MODULE_SUPPORT_WXAPP_NAME] != MODULE_SUPPORT_WXAPP) {
				continue;
			}
			if (!empty($module_info)) {
				$module_list[$name] = $module_info;
			}
		}
	}
	$module_list['core'] = array('title' => '系统事件处理模块', 'name' => 'core', 'issystem' => 1, 'enabled' => 1, 'isdisplay' => 0);
	return $module_list;
}

/**
 * 获取当前公号下所有安装模块及模块信息
 * @return array 模块列表
 */
function uni_modules() {
	global $_W;
	return uni_modules_by_uniacid($_W['uniacid']);
}

function uni_modules_app_binding() {
	global $_W;
	$cachekey = cache_system_key('unimodules_binding', array('uniacid' => $_W['uniacid']));
	$cache = cache_load($cachekey);
	if (!empty($cache)) {
		return $cache;
	}
	load()->model('module');
	$result = array();
	$modules = uni_modules();
	if (!empty($modules)) {
		foreach ($modules as $module) {
			if ($module['type'] == 'system') {
				continue;
			}
			$entries = module_app_entries($module['name'], array('home', 'profile', 'shortcut', 'function', 'cover'));
			if (empty($entries)) {
				continue;
			}
			if ($module['type'] == '') {
				$module['type'] = 'other';
			}
			$result[$module['name']] = array(
				'name' => $module['name'],
				'type' => $module['type'],
				'title' => $module['title'],
				'entries' => array(
					'cover' => $entries['cover'],
					'home' => $entries['home'],
					'profile' => $entries['profile'],
					'shortcut' => $entries['shortcut'],
					'function' => $entries['function']
				)
			);
			unset($module);
		}
	}
	cache_write($cachekey, $result);
	return $result;
}

/**
 * 获取一个或多个公众号套餐信息
 * @param array $groupids 公众号套餐ID
 * @return array uni_group 套餐信息列表
 */
function uni_groups($groupids = array(), $show_all = false) {
	load()->model('module');
	global $_W;
	$cache_key_id = 0;
	if (!empty($groupids)) {
		foreach ($groupids as $groupid_key => $groupid_val) {
			$groupid_val = intval($groupid_val);
			$groupids[$groupid_key] = $groupid_val;
			$cache_key_id .= $groupid_val;
		}
	}
	$cachekey = cache_system_key('uni_groups', array('groupids' => $cache_key_id));
	$list = cache_load($cachekey);
	if (empty($list)) {
		$condition = array('uniacid' => 0, 'uid' => 0);
		if (!empty($groupids)) {
			foreach ($groupids as $groupid_key => $groupid_val) {
				$groupids[$groupid_key] = intval($groupid_val);
			}
			$condition['id IN'] = $groupids;
		}
		$list = table('uni_group')->where($condition)->orderby('id', 'desc')->getall('id');
		if (!empty($groupids)) {
			if (in_array('-1', $groupids)) {
				$list[-1] = array('id' => -1, 'name' => '所有服务', 'modules' => array('title' => '系统所有模块'), 'templates' => array('title' => '系统所有模板'));
			}
			if (in_array('0', $groupids)) {
				$list[0] = array('id' => 0, 'name' => '基础服务', 'modules' => array('title' => '系统模块'), 'templates' => array('title' => '系统模板'));
			}
		}

		if (!empty($list)) {
			foreach ($list as $k => &$row) {
				$modules = (array)iunserializer($row['modules']);
				# 获取应用套餐里所有模块及详情(并按类型分组)
				$row['modules_all'] = array();
				if (!empty($modules)) {
					foreach ($modules as $type => $modulenames) {
						$type = $type == 'modules' ? 'account' : $type;
						if (empty($modulenames) || !is_array($modulenames)) {
							continue;
						}
						$row['modules_all'] = array_merge($row['modules_all'], $modulenames);
						$row[$type] = empty($row[$type]) ? $modulenames : array_merge($row[$type], $modulenames);
					}
					$row['modules_all'] = array_unique($row['modules_all']);
				}

				# 获取应用套餐内所有的模板
				if (!empty($row['templates'])) {
					$row['templates'] = (array)iunserializer($row['templates']);
					if (!empty($row['templates'])) {
						$row['templates'] = table('modules')->getAllTemplateByIds($row['templates'], 'name');
					}
				}
			}
		}
		cache_write($cachekey, $list);
	}
	$group_list = array();
	if (empty($list)) {
		return $group_list;
	}
	//因为权限组里各个类型的模块有重复，因此数据量大的话，循环调用module_fetch()重复获取同一模块信息，损耗性能。
	//故外围定义一个大数组，存在的话不进行module_fetch()
	$modules_info = array();
	foreach ($list as &$item) {
		if (empty($item['modules_all'])) {
			continue;
		}

		$modules_all = $item['modules_all'];
		$item['modules_all'] = array();
		//大数据量的客户不可以使用这个foreach，而是使用下面的if判断。否则加载时间更长。但是注意增加账号类型的时候要及时添加
		//数据量小的可以使用这个foreach
		//foreach ($module_support_type_sign as $type) {
		//	if (empty($item[$type]) || !is_array($item[$type])) {
		//		continue;
		//	}
		//	$module_type = $item[$type];
		//	$item[$type] = array();
		//	foreach ($module_type as $name) {
		//		$item[$type][$name] = $modules_info[$name];
		//	}
		//}
		if (!empty($item['account'])) {
			$account_modules = $item['account'];
			$item['account'] = array();
			foreach ($account_modules as $name) {
				if (empty($modules_info[$name]) || !is_array($modules_info[$name])) {
					$modules_info[$name] = module_main_info($name);
				}
				if (empty($item['modules_all'][$name])) {
					$item['modules_all'][$name] = $modules_info[$name];
				}
				if (in_array($name, $modules_all)) {
					$item['modules_all'][$name]['group_support']['account_support'] = 2;
				}
				$item['account'][$name] = $modules_info[$name];
			}
		}
		if (!empty($item['wxapp'])) {
			$wxapp_modules = $item['wxapp'];
			$item['wxapp'] = array();
			foreach ($wxapp_modules as $name) {
				if (empty($modules_info[$name]) || !is_array($modules_info[$name])) {
					$modules_info[$name] = module_main_info($name);
				}
				if (empty($item['modules_all'][$name])) {
					$item['modules_all'][$name] = $modules_info[$name];
				}
				if (in_array($name, $modules_all)) {
					$item['modules_all'][$name]['group_support']['wxapp_support'] = 2;
				}
				$item['wxapp'][$name] = $modules_info[$name];
			}
		}
		if (!empty($item['webapp'])) {
			$wxapp_modules = $item['webapp'];
			$item['webapp'] = array();
			foreach ($wxapp_modules as $name) {
				if (empty($modules_info[$name]) || !is_array($modules_info[$name])) {
					$modules_info[$name] = module_main_info($name);
				}
				if (empty($item['modules_all'][$name])) {
					$item['modules_all'][$name] = $modules_info[$name];
				}
				if (in_array($name, $modules_all)) {
					$item['modules_all'][$name]['group_support']['webapp_support'] = 2;
				}
				$item['webapp'][$name] = $modules_info[$name];
			}
		}
		if (!empty($item['phoneapp'])) {
			$phoneapp_modules = $item['phoneapp'];
			$item['phoneapp'] = array();
			foreach ($phoneapp_modules as $name) {
				if (empty($modules_info[$name]) || !is_array($modules_info[$name])) {
					$modules_info[$name] = module_main_info($name);
				}
				if (empty($item['modules_all'][$name])) {
					$item['modules_all'][$name] = $modules_info[$name];
				}
				if (in_array($name, $modules_all)) {
					$item['modules_all'][$name]['group_support']['phoneapp_support'] = 2;
				}
				$item['phoneapp'][$name] = $modules_info[$name];
			}
		}
		if (!empty($item['aliapp'])) {
			$aliapp_modules = $item['aliapp'];
			$item['aliapp'] = array();
			foreach ($aliapp_modules as $name) {
				if (empty($modules_info[$name]) || !is_array($modules_info[$name])) {
					$modules_info[$name] = module_main_info($name);
				}
				if (empty($item['modules_all'][$name])) {
					$item['modules_all'][$name] = $modules_info[$name];
				}
				if (in_array($name, $modules_all)) {
					$item['modules_all'][$name]['group_support']['aliapp_support'] = 2;
				}
				$item['aliapp'][$name] = $modules_info[$name];
			}
		}
		if (!empty($item['baiduapp'])) {
			$baiduapp_modules = $item['baiduapp'];
			$item['baiduapp'] = array();
			foreach ($baiduapp_modules as $name) {
				if (empty($modules_info[$name]) || !is_array($modules_info[$name])) {
					$modules_info[$name] = module_main_info($name);
				}
				if (empty($item['modules_all'][$name])) {
					$item['modules_all'][$name] = $modules_info[$name];
				}
				if (in_array($name, $modules_all)) {
					$item['modules_all'][$name]['group_support']['baiduapp_support'] = 2;
				}
				$item['baiduapp'][$name] = $modules_info[$name];
			}
		}
		if (!empty($item['toutiaoapp'])) {
			$toutiaoapp_modules = $item['toutiaoapp'];
			$item['toutiaoapp'] = array();
			foreach ($toutiaoapp_modules as $name) {
				if (empty($modules_info[$name]) || !is_array($modules_info[$name])) {
					$modules_info[$name] = module_main_info($name);
				}
				if (empty($item['modules_all'][$name])) {
					$item['modules_all'][$name] = $modules_info[$name];
				}
				if (in_array($name, $modules_all)) {
					$item['modules_all'][$name]['group_support']['toutiaoapp_support'] = 2;
				}
				$item['toutiaoapp'][$name] = $modules_info[$name];
			}
		}
		if (!empty($item['welcome'])) {
			$welcome_modules = $item['welcome'];
			$item['welcome'] = array();
			foreach ($welcome_modules as $name) {
				if (empty($modules_info[$name]) || !is_array($modules_info[$name])) {
					$modules_info[$name] = module_main_info($name);
				}
				if (empty($item['modules_all'][$name])) {
					$item['modules_all'][$name] = $modules_info[$name];
				}
				if (in_array($name, $modules_all)) {
					$item['modules_all'][$name]['group_support']['welcome_support'] = 2;
				}
				$item['welcome'][$name] = $modules_info[$name];
			}
		}
	}

	if (!empty($groupids)) {
		foreach ($groupids as $id) {
			$group_list[$id] = $list[$id];
		}
	} else {
		if (user_is_vice_founder() && empty($show_all)) {
			$founder_own_table = table('users_founder_own_uni_groups');
			$founder_own_uni_groups = $founder_own_table->getOwnUniGroupsByFounderUid($_W['uid']);
			foreach ($list as $group_key => $group) {
				if (!in_array($group_key, array_keys($founder_own_uni_groups))) {
					unset($list[$group_key]);
					continue;
				}
			}
		}
		$group_list = $list;
	}

	return $group_list;
}

/**
 * 获取当前套餐可用微站模板
 * @return array 模板列表
 */
function uni_templates() {
	global $_W;
	load()->model('user');
	$owneruid = pdo_fetchcolumn("SELECT uid FROM " . tablename('uni_account_users') . " WHERE uniacid = :uniacid AND role = 'owner'", array(':uniacid' => $_W['uniacid']));
	//如果没有所有者，则取创始人权限
	$owner = user_single(array('uid' => $owneruid));
	if (empty($owner) || user_is_founder($owner['uid'])) {
		$groupid = '-1';
	} else {
		$groupid = $owner['groupid'];
	}
	if ($groupid == '-1') {
		$templates = table('modules')->getAllTemplates('mid');
		return $templates;
	}

	$extend = pdo_getall('uni_account_group', array('uniacid' => $_W['uniacid']), array(), 'groupid');//附加权限组
	$uni_extend = pdo_get('uni_account_extra_modules', array('uniacid' => $_W['uniacid']));//附加应用
	$owner_extend_groups = table('users_extra_group')->getUniGroupsByUid($owneruid);
	$owner_extend_templates = table('users_extra_modules')->getExtraModulesByUid($owneruid);
	//为了统一返回数据格式,故用pdo_fetchall,实际只有一条
	$modules_table = table('modules');
	$modules_table->searchTemplateWithName('default');
	$template_default = $modules_table->getAllTemplates('mid');

	if (empty($groupid) && empty($extend) && empty($uni_extend) && empty($owner_extend_groups) && empty($owner_extend_templates)) {
		return $template_default;
	}

	$group = pdo_fetch("SELECT id, name, package FROM " . tablename('users_group') . " WHERE id = :id", array(':id' => $groupid));
	$packageids = iunserializer($group['package']);
	if (!is_array($packageids)) {
		$packageids = array();
	}
	if (!empty($extend)) {
		foreach ($extend as $extend_packageid => $row) {
			$packageids[] = $extend_packageid;
		}
	}

	if (!empty($owner_extend_groups)) {
		foreach ($owner_extend_groups as $id => $row) {
			$packageids[] = $id;
		}
	}
	if (in_array('-1', $packageids)) {
		return table('modules')->getAllTemplates('mid');
	}

	$template_modules = array();
	if (!empty($packageids)) {
		$wechatgroup = table('uni_group')->where(array('id' => $packageids))->getall();
		if (!empty($wechatgroup)) {
			foreach ($wechatgroup as $row) {
				$account_modules = iunserializer($row['modules']);
				if (!is_array($account_modules['modules']) || empty($account_modules['modules'])) {
					continue;
				}
				foreach ($account_modules['modules'] as $module_name) {
					$template_modules[] = $module_name;
				}
			}
		}
	}
	if (!empty($uni_extend)) {
		$uni_extend_modules = iunserializer($uni_extend['modules']);
		if (is_array($uni_extend_modules['modules']) && !empty($uni_extend_modules['modules'])) {
			foreach ($uni_extend_modules['modules'] as $module_name) {
				$template_modules[] = $module_name;
			}
		}
	}
	$template_modules = array_unique($template_modules);
	$template_modules[] = 'default';
	if (is_array($owner_extend_templates)) {
		$template_modules = array_merge($template_modules, array_column($owner_extend_templates, 'module_name'));
	}
	$result = table('modules')->getTemplateByNames($template_modules, 'mid');
	return $result;
}

/**
 * 保存公众号的配置数据
 * @param string $name
 * @param mixed $value
 * @return boolean
 */
function uni_setting_save($name, $value) {
	global $_W;
	$uniacid = !empty($_W['uniacid']) ? $_W['uniacid'] : $_W['account']['uniacid'];
	if (empty($name)) {
		return false;
	}
	if (is_array($value)) {
		$value = serialize($value);
	}
	$unisetting = pdo_get('uni_settings', array('uniacid' => $uniacid), array('uniacid'));
	if (!empty($unisetting)) {
		pdo_update('uni_settings', array($name => $value), array('uniacid' => $uniacid));
	} else {
		pdo_insert('uni_settings', array($name => $value, 'uniacid' => $uniacid));
	}
	cache_delete(cache_system_key('uniaccount', array('uniacid' => $uniacid)));
	return true;
}

/**
 * 获取公众号的配置项
 * @param string | array $name
 * @param int $uniacid 统一公号id, uniacid
 * @return array 设置项
 */
function uni_setting_load($name = '', $uniacid = 0) {
	global $_W;
	$uniacid = empty($uniacid) ? $_W['uniacid'] : $uniacid;
	$cachekey = cache_system_key('unisetting', array('uniacid' => $uniacid));
	$unisetting = cache_load($cachekey);
	if (empty($unisetting) || ($name == 'remote' && empty($unisetting['remote']))) {
		$unisetting = pdo_get('uni_settings', array('uniacid' => $uniacid));
		if (!empty($unisetting)) {
			$serialize = array('site_info', 'stat', 'oauth', 'passport', 'notify',
				'creditnames', 'default_message', 'creditbehaviors', 'payment',
				'recharge', 'tplnotice', 'mcplugin', 'statistics', 'bind_domain', 'remote');
			foreach ($unisetting as $key => &$row) {
				if (in_array($key, $serialize) && !empty($row)) {
					$row = (array)iunserializer($row);
				}
			}
		} else {
			$unisetting = array();
		}
		cache_write($cachekey, $unisetting);
	}
	if (empty($unisetting)) {
		return array();
	}
	if (empty($name)) {
		return $unisetting;
	}
	if (!is_array($name)) {
		$name = array($name);
	}
	return array_elements($name, $unisetting);
}

function uni_account_user_role_insert($uniacid, $uid, $role) {
	$vice_account = array(
		'uniacid' => intval($uniacid),
		'uid' => intval($uid),
		'role' => trim($role)
	);
	$account_user = pdo_get('uni_account_users', $vice_account, array('id'));
	if (!empty($account_user)) {
		return false;
	}
	return pdo_insert('uni_account_users', $vice_account);
}

/**
 * 获取公众号和小程序真实数量
 * @param $uid
 * @param $role
 * @return array
 */
function uni_owner_account_nums($uid, $role) {
	$account_all_type = uni_account_type();
	$account_all_type_sign = array_keys(uni_account_type_sign());

	foreach ($account_all_type_sign as $type_info) {
		$key_name = $type_info . '_num';
		$num[$key_name] = 0;
	}

	$uniacocunts = table('account')->searchAccountList();

	if (!empty($uniacocunts)) {
		$uni_account_users_table = table('uni_account_users');
		$uni_account_users_table->searchWithRole($role);
		$all_account = $uni_account_users_table->getCommonUserOwnAccountUniacids($uid);

		foreach ($all_account as $account) {
			foreach ($account_all_type as $type_key => $type_info) {
				if ($type_key == $account['type']) {
					$key_name = $type_info['type_sign'] . '_num';
					$num[$key_name] += 1;
					continue;
				}
			}
		}
	}

	return $num;
}
function uni_update_week_stat() {
	global $_W;
	$cachekey = cache_system_key('stat_todaylock', array('uniacid' => $_W['uniacid']));
	$cache = cache_load($cachekey);
	if (!empty($cache) && $cache['expire'] > TIMESTAMP) {
		return true;
	}
	$seven_days = array(
		date('Ymd', strtotime('-1 days')),
		date('Ymd', strtotime('-2 days')),
		date('Ymd', strtotime('-3 days')),
		date('Ymd', strtotime('-4 days')),
		date('Ymd', strtotime('-5 days')),
		date('Ymd', strtotime('-6 days')),
		date('Ymd', strtotime('-7 days')),
	);

	$week_stat_fans = pdo_getall('stat_fans', array('date' => $seven_days, 'uniacid' => $_W['uniacid']), '', 'date');
	$stat_update_yes = false;
	foreach ($seven_days as $sevens) {
		if (empty($week_stat_fans[$sevens]) || $week_stat_fans[$sevens]['cumulate'] <= 0) {
			$stat_update_yes = true;
			break;
		}
	}
	if (empty($stat_update_yes)) {
		return true;
	}
	$account = uni_fetch($_W['uniacid']);
	if (is_error($account)) {
		return $account;
	}
	if ($account['level'] == ACCOUNT_SUBSCRIPTION_VERIFY || $account['level'] == ACCOUNT_SERVICE_VERIFY) {
		$account_obj = WeAccount::createByUniacid();
		$weixin_stat = $account_obj->getFansStat();
		if (empty($weixin_stat) || is_error($weixin_stat)) {
			return error(-1, '调用微信接口错误');
		}
	}
	foreach ($seven_days as $sevens) {
		if ($account['level'] == ACCOUNT_SUBSCRIPTION_VERIFY || $account['level'] == ACCOUNT_SERVICE_VERIFY) {
			$update_stat = array(
				'uniacid' => $_W['uniacid'],
				'new' => $weixin_stat[$sevens]['new'],
				'cancel' => $weixin_stat[$sevens]['cancel'],
				'cumulate' => $weixin_stat[$sevens]['cumulate'],
				'date' => $sevens,
			);
		} else {
			$update_stat = array(
				'cumulate' => pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('mc_mapping_fans') . " WHERE uniacid = :uniacid AND follow = :follow AND followtime < :endtime", array(':uniacid' => $_W['uniacid'], ':endtime' => strtotime($sevens) + 86400, ':follow' => 1)),
				'date' => $sevens,
				'new' => $week_stat_fans[$sevens]['new'],
				'cancel' => $week_stat_fans[$sevens]['cancel'],
				'uniacid' => $_W['uniacid'],
			);
		}
		if (empty($week_stat_fans[$sevens])) {
			pdo_insert('stat_fans', $update_stat);
		} elseif (empty($week_stat_fans[$sevens]['cumulate']) || $week_stat_fans[$sevens]['cumulate'] < 0) {
			pdo_update('stat_fans', $update_stat, array('id' => $week_stat_fans[$sevens]['id']));
		}
	}
	cache_write($cachekey, array('expire' => TIMESTAMP + 7200));
	return true;
}

/**
 * 创建子公众号
 * @param int $uniacid 指定统一公号
 * @param array $account 子公号信息
 * @return int 新创建的子公号 acid
 */
function account_create($uniacid, $account) {
	global $_W;
	$account_all_type = uni_account_type();
	$type = $account['type'];
	$type_sign = $account_all_type[$type]['type_sign'];
	unset($account['type']);

	$accountdata = array('uniacid' => $uniacid, 'type' => $type, 'hash' => random(8));

	if (!$_W['isadmin']) {
		$accountdata['endtime'] = $_W['user']['endtime'];
	}
	pdo_insert('account', $accountdata);
	$acid = pdo_insertid();

	$account['acid'] = $acid;
	$account['uniacid'] = $uniacid;
	if (in_array($type_sign, array(ACCOUNT_TYPE_SIGN))) {
		$account['token'] = random(32);
		$account['encodingaeskey'] = random(43);
	}
	pdo_insert($account_all_type[$type]['table_name'], $account);
	return $acid;
}

/**
 * 获取指定子公号信息
 * @param int $acid 子公号acid
 * @return array
 */
function account_fetch($acid) {
	$account_info = pdo_get('account', array('acid' => $acid));
	if (empty($account_info)) {
		return error(-1, '公众号不存在');
	}
	return uni_fetch($account_info['uniacid']);
}

/*
 * 获取某个公众号的所有人和套餐有效期限（如果没有所有人，默认属于创始人，服务创始人）
 * */
function uni_setmeal($uniacid = 0) {
	global $_W;
	if (!$uniacid) {
		$uniacid = $_W['uniacid'];
	}
	$owneruid = pdo_fetchcolumn("SELECT uid FROM " . tablename('uni_account_users') . " WHERE uniacid = :uniacid AND role = 'owner'", array(':uniacid' => $uniacid));
	if (empty($owneruid)) {
		$user = array(
			'uid' => -1,
			'username' => '创始人',
			'timelimit' => '未设置',
			'groupid' => '-1',
			'groupname' => '所有服务'
		);
		return $user;
	}
	load()->model('user');
	$groups = pdo_getall('users_group', array(), array('id', 'name'), 'id');
	$owner = user_single(array('uid' => $owneruid));
	$user = array(
		'uid' => $owner['uid'],
		'username' => $owner['username'],
		'groupid' => $owner['groupid'],
		'groupname' => empty($groups[$owner['groupid']]['name']) ? '' : $groups[$owner['groupid']]['name']
	);
	if (empty($owner['endtime'])) {
		$user['timelimit'] = date('Y-m-d', $owner['starttime']) . ' ~ 无限制' ;
	} else {
		if ($owner['endtime'] <= TIMESTAMP) {
			$user['timelimit'] = '已到期';
		} else {
			$year = 0;
			$month = 0;
			$day = 0;
			$endtime = $owner['endtime'];
			$time = strtotime('+1 year');
			if ($endtime > $time) {
				$year = $year + 1;
				$time = strtotime("+1 year", $time);
			}
			$time = strtotime("-1 year", $time);
			$time = strtotime("+1 month", $time);
			if ($endtime > $time) {
				$month = $month + 1;
				$time = strtotime("+1 month", $time);
			}
			$time = strtotime("-1 month", $time);
			$time = strtotime("+1 day", $time);
			if ($endtime > $time) {
				$day = $day + 1;
				$time = strtotime("+1 day", $time);
			}
			if (empty($year)) {
				$timelimit = empty($month) ? $day . '天' : date('Y-m-d', $owner['starttime']) . '~' . date('Y-m-d', $owner['endtime']);
			} else {
				$timelimit = date('Y-m-d', $owner['starttime']) . '~' . date('Y-m-d', $owner['endtime']);
			}
			$user['timelimit'] = $timelimit;
		}
	}
	return $user;
}

/**
 * 删除公众号
 * @param string $uniacid 微信公众号的uniacid
 */
function account_delete($uniacid) {
	global $_W;
	load()->func('file');
	load()->model('module');
	load()->model('job');
	//判断是不是主公众号
	$account = pdo_get('uni_account', array('uniacid' => $uniacid));
	if (empty($account)) {
		itoast('公众号不存在或是已经被删除', '', '');
	}
	$state = permission_account_user_role($_W['uid'], $uniacid);
	if (!in_array($state, array(ACCOUNT_MANAGE_NAME_OWNER, ACCOUNT_MANAGE_NAME_FOUNDER, ACCOUNT_MANAGE_NAME_VICE_FOUNDER))) {
		itoast('没有该公众号操作权限！', url('account/recycle'), 'error');
	}
	if ($uniacid == $_W['uniacid']) {
		isetcookie('__uniacid', '');
	}
	cache_delete(cache_system_key('uniaccount', array('uniacid' => $uniacid)));
	//获取全部规则
	$rules = pdo_getall('rule', array('uniacid' => $uniacid), array('id', 'module'));
	if (!empty($rules)) {
		foreach ($rules as $index => $rule) {
			$deleteid[] = intval($rule['id']);
		}
		table('rule')->where('id IN', $deleteid)->delete();
	}

	@unlink(IA_ROOT . '/attachment/qrcode_' . $uniacid . '.jpg');
	@unlink(IA_ROOT . '/attachment/headimg_' . $uniacid . '.jpg');
	file_remote_delete('qrcode_' . $uniacid . '.jpg');
	file_remote_delete('headimg_' . $uniacid . '.jpg');
	$jobid = job_create_delete_account($uniacid, $account['name'], $_W['uid']);

	//遍历全部表删除公众号数据
	$tables = array(
		'account', 'account_wechats', 'account_wxapp', 'wxapp_versions', 'account_webapp', 'account_phoneapp',
		'core_paylog', 'cover_reply', 'mc_chats_record', 'mc_credits_recharge', 'mc_credits_record',
		'mc_fans_groups', 'mc_groups', 'mc_handsel', 'mc_mapping_fans', 'mc_mass_record', 'mc_member_address',
		'mc_member_fields', 'mc_members', 'menu_event', 'qrcode', 'qrcode_stat', 'rule', 'rule_keyword',
		'site_article', 'site_category', 'site_multi', 'site_nav', 'site_slide', 'site_styles', 'site_styles_vars',
		'stat_keyword', 'stat_rule', 'uni_account', 'uni_account_modules', 'uni_account_users', 'uni_settings',
		'uni_group', 'uni_account_extra_modules', 'uni_verifycode', 'users_permission', 'wechat_news',
		'users_lastuse', 'users_operate_history', 'users_operate_star'
	);
	foreach ($tables as $table) {
		$tablename = str_replace($GLOBALS['_W']['config']['db']['tablepre'], '', $table);
		pdo_delete($tablename, array( 'uniacid' => $uniacid));
	}

	return $jobid;
}

/**
 * 获取所有可借用支付的公众号
 * @return array() 微信支付可借用的的公众号和服务商公众号
 */
function account_wechatpay_proxy() {
	global $_W;
	$proxy_account = cache_load(cache_system_key('proxy_wechatpay_account'));
	if (empty($proxy_account)) {
		$proxy_account = cache_build_proxy_wechatpay_account();
	}
	unset($proxy_account['borrow'][$_W['uniacid']]);
	unset($proxy_account['service'][$_W['uniacid']]);
	return $proxy_account;
}

/**
 * 设置模块是否在快捷菜单显示
 */
function uni_account_module_shortcut_enabled($modulename, $status = STATUS_ON) {
	global $_W;
	$module = module_fetch($modulename);
	if (empty($module)) {
		return error(1, '抱歉，你操作的模块不能被访问！');
	}

	$module_status = pdo_get('uni_account_modules', array('module' => $modulename, 'uniacid' => $_W['uniacid']), array('id', 'shortcut'));
	if (empty($module_status)) {
		$data = array(
			'uniacid' => $_W['uniacid'],
			'module' => $modulename,
			'enabled' => STATUS_ON,
			'shortcut' => $status ? STATUS_ON : STATUS_OFF,
			'settings' => '',
		);
		pdo_insert('uni_account_modules', $data);
	} else {
		$data = array(
			'shortcut' => $status ? STATUS_ON : STATUS_OFF,
		);
		pdo_update('uni_account_modules', $data, array('id' => $module_status['id']));
	}
	cache_build_module_info($modulename);
	return true;
}

/**
 * 获取某公众号下会员字段
 * @param int $uniacid
 * @return array 会员字段数组
 */
function uni_account_member_fields($uniacid) {
	if (empty($uniacid)) {
		return array();
	}
	$account_member_fields = pdo_getall('mc_member_fields', array('uniacid' => $uniacid), array(), 'fieldid');
	$system_member_fields = pdo_getall('profile_fields', array(), array(), 'id');
	$less_field_indexes = array_diff(array_keys($system_member_fields), array_keys($account_member_fields));
	if (empty($less_field_indexes)) {
		foreach ($account_member_fields as &$field) {
			$field['field'] = $system_member_fields[$field['fieldid']]['field'];
		}
		unset($field);
		return $account_member_fields;
	}

	$account_member_add_fields = array('uniacid' => $uniacid);
	foreach ($less_field_indexes as $field_index) {
		$account_member_add_fields['fieldid'] = $system_member_fields[$field_index]['id'];
		$account_member_add_fields['title'] = $system_member_fields[$field_index]['title'];
		$account_member_add_fields['available'] = $system_member_fields[$field_index]['available'];
		$account_member_add_fields['displayorder'] = $system_member_fields[$field_index]['displayorder'];
		pdo_insert('mc_member_fields', $account_member_add_fields);
		$insert_id = pdo_insertid();
		$account_member_fields[$insert_id]['id'] = $insert_id;
		$account_member_fields[$insert_id]['field'] = $system_member_fields[$field_index]['field'];
		$account_member_fields[$insert_id]['fid'] = $system_member_fields[$field_index]['id'];
		$account_member_fields[$insert_id] = array_merge($account_member_fields[$insert_id], $account_member_add_fields);
	}
	return $account_member_fields;
}

/**
 * 获取全局oauth信息
 * @return string
 */
function uni_account_global_oauth() {
	load()->model('setting');
	$oauth = setting_load('global_oauth');
	$oauth = !empty($oauth['global_oauth']) ? $oauth['global_oauth'] : array();
	if (!empty($oauth['oauth']['account'])) {
		$account_exist = uni_fetch($oauth['oauth']['account']);
		if (empty($account_exist) || is_error($account_exist)) {
			$oauth['oauth']['account'] = 0;
		}
	}
	return $oauth;
}

function uni_search_link_account($module_name, $type_sign, $uniacid = 0) {
	global $_W;
	load()->model('miniapp');
	load()->model('phoneapp');
	$module_name = trim($module_name);
	if (empty($module_name) || empty($type_sign)) {
		return array();
	}
	$all_account_type = uni_account_type();
	$all_account_type_sign = uni_account_type_sign();
	if (empty($all_account_type_sign[$type_sign])) {
		return array();
	}
	$owned_account = uni_user_accounts($_W['uid'], $type_sign);

	if (!empty($owned_account)) {
		foreach ($owned_account as $key => $account) {
			if (!empty($uniacid) && $account['uniacid'] == $uniacid) {
				unset($owned_account[$key]);
				continue;
			}
			$account['role'] = permission_account_user_role($_W['uid'], $account['uniacid']);
			if (!in_array($account['role'], array(ACCOUNT_MANAGE_NAME_OWNER, ACCOUNT_MANAGE_NAME_VICE_FOUNDER, ACCOUNT_MANAGE_NAME_FOUNDER))) {
				unset($owned_account[$key]);
				continue;
			}
			$account_modules = uni_modules_by_uniacid($account['uniacid']);
			if (empty($account_modules[$module_name])) {
				unset($owned_account[$key]);
				continue;
			}
			//账号模块不支持当前需要的类型时,不可被关联
			$type = $all_account_type_sign[$type_sign]['contain_type'][0];
			$type_info = $all_account_type[$type];
			if ($account_modules[$module_name][$type_info['module_support_name']] != $type_info['module_support_value']) {
				unset($owned_account[$key]);
				continue;
			}
			$account_support_version = array_filter($all_account_type, function ($item) {
				return $item['support_version'];
			});
			$account_support_version = array_keys($account_support_version);
			if (in_array($type, $account_support_version)) {
				$last_version = miniapp_fetch($account['uniacid']);
				if (empty($last_version['version']) || empty($last_version['version']['modules']) || !is_array($last_version['version']['modules'])) {
					unset($owned_account[$key]);
					continue;
				}
				//账号版本中没有该模块, 或者模块已经关联了其他账号, 则不可被关联
				$module_version = array();
				foreach ($last_version['version']['modules'] as $item) {
					if (!empty($item['name']) && $item['name'] == $module_name) {
						$module_version = $item;
						break;
					}
				}
				if (empty($module_version) || !empty($module_version['account']) || !empty($module_version['uniacid'])) {
					unset($owned_account[$key]);
					continue;
				}
			}
		}
	}
	return $owned_account;
}

/**
 * 获取公众号的有效的 oauth 域名
 * @param $unisetting
 */
function uni_account_oauth_host() {
	global $_W;
	$oauth_url = $_W['siteroot'];
	$unisetting = uni_setting_load();
	if (!empty($unisetting['bind_domain']) && !empty($unisetting['bind_domain']['domain'])) {
		$oauth_url = $unisetting['bind_domain']['domain'] . '/';
	} else {
		if (ACCOUNT_TYPE_OFFCIAL_NORMAL == $_W['account']['type']) {
			if (!empty($unisetting['oauth']['host'])) {
				$oauth_url = $unisetting['oauth']['host'] . '/';
			} else {
				$global_unisetting = uni_account_global_oauth();
				$oauth_url = !empty($global_unisetting['oauth']['host']) ? $global_unisetting['oauth']['host'] . '/' : $oauth_url;
			}
		}
	}
	return $oauth_url;
}

/**
 * 用户可查看到的额外信息(已废弃,但是有些开发者模块内使用,故不可删除)
 * @param array $param
 * @return boolean
 */
function uni_user_see_more_info($user_type, $see_more = false) {
	global $_W;
	if (empty($user_type)) {
		return false;
	}
	if ($user_type == ACCOUNT_MANAGE_NAME_VICE_FOUNDER && !empty($see_more) || $_W['role'] != $user_type) {
		return true;
	}

	return false;
}

/**
 * @param $rid 规则ID
 * @param $relate_table_name 关联的回复表
 * @return bool
 */
function uni_delete_rule($rid, $relate_table_name) {
	global $_W;
	$rid = intval($rid);
	if (empty($rid)) {
		return false;
	}
	$allowed_table_names = array('news_reply', 'cover_reply');
	if (!in_array($relate_table_name, $allowed_table_names)) {
		return false;
	}
	$rule_result = pdo_delete('rule', array('id' => $rid, 'uniacid' => $_W['uniacid']));
	$rule_keyword_result = pdo_delete('rule_keyword', array('rid' => $rid, 'uniacid' => $_W['uniacid']));
	if ($rule_result && $rule_keyword_result) {
		$result = pdo_delete($relate_table_name, array('rid' => $rid));
	}
	return $result ? true : false;
}

function uni_get_account_by_appid($appid, $account_type, $except_uniacid = 0) {
	$type_info = uni_account_type($account_type);

	//pc和app没有appid
	if (in_array($type_info['type_sign'], array(WEBAPP_TYPE_SIGN, PHONEAPP_TYPE_SIGN))) {
		return array();
	}
	$sql = 'SELECT t.`key`, t.name, a.acid, a.uniacid FROM '
		. tablename($type_info['table_name'])
		. 't JOIN ' . tablename('account')
		. ' a ON t.uniacid = a.uniacid WHERE a.isdeleted != 1';

	if (in_array($type_info['type_sign'], array(BAIDUAPP_TYPE_SIGN, TOUTIAOAPP_TYPE_SIGN))) {
		$sql .= ' AND t.`appid` = :appid';
	} else {
		//公众号, 微信小程序, 支付宝小程序: key 即 appid
		$sql .= ' AND t.`key` = :appid';
	}
	$params = array(':appid' => $appid);
	if (!empty($except_uniacid)) {
		$sql .= ' AND a.uniacid != :except_uniacid';
		$params[':except_uniacid'] = intval($except_uniacid);
	}

	$account = pdo_fetch($sql, $params);
	if (!empty($account)) {
		$account['type_title'] = $type_info['title'];
		$account['key_title'] = 'AppId';
	}
	return $account;
}
