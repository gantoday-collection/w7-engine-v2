<?php
/**
 * 素材管理列表页
 * [WeEngine System] Copyright (c) 2014 W7.CC.
 */
defined('IN_IA') or exit('Access Denied');
load()->model('material');
load()->model('mc');
load()->model('account');
load()->model('attachment');
load()->func('file');

$dos = array('display', 'sync', 'delete', 'send', 'detail');
$do = in_array($do, $dos) ? $do : 'display';

if ('send' == $do) {
	$platform_send_permission = permission_check_account_user('platform_masstask_post', false);
	if (false === $platform_send_permission) {
		iajax(1, '您没有进行该操作的权限', '');
	}
	$group = intval($_GPC['group']);
	$type = safe_gpc_string($_GPC['type']);
	$id = intval($_GPC['id']);
	$media = pdo_get('wechat_attachment', array('uniacid' => $_W['uniacid'], 'id' => $id));
	if (empty($media)) {
		iajax(1, '素材不存在', '');
	}
	$group = $group > 0 ? $group : -1;
	$account_api = WeAccount::createByUniacid();
	$result = $account_api->fansSendAll($group, $type, $media['media_id']);
	if (is_error($result)) {
		iajax(1, $result['message'], '');
	}
	$groups = pdo_get('mc_fans_groups', array('uniacid' => $_W['uniacid']));
	if (!empty($groups)) {
		$groups = iunserializer($groups['groups']);
	}
	if ($group == -1) {
		$groups = array(
				$group => array(
						'name' => '全部粉丝',
						'count' => 0,
				),
		);
	}
	$record = array(
		'uniacid' => $_W['uniacid'],
		'acid' => $_W['acid'],
		'groupname' => $groups[$group]['name'],
		'fansnum' => $groups[$group]['count'],
		'msgtype' => $type,
		'group' => $group,
		'attach_id' => $id,
		'media_id' => $media['media_id'],
		'status' => 0,
		'type' => 0,
		'sendtime' => TIMESTAMP,
		'createtime' => TIMESTAMP,
	);
	pdo_insert('mc_mass_record', $record);
	iajax(0, '发送成功！', '');
}

if ('display' == $do) {
	$type = empty($_GPC['type']) ? '' : safe_gpc_string($_GPC['type']);
	$type = in_array($type, array('image', 'voice', 'video')) ? $type : 'image';
	permission_check_account_user('platform_material_' . $type);
	$server = !empty($_GPC['server']) && in_array($_GPC['server'], array(MATERIAL_LOCAL, MATERIAL_WEXIN)) ? safe_gpc_string($_GPC['server']) : '';
	$group = mc_fans_groups(true);
	$page_index = empty($_GPC['page']) ? 1 : intval($_GPC['page']);
	$page_size = 24;
	$search = empty($_GPC['title']) ? '' : addslashes($_GPC['title']);

	if ('news' == $type) {
		$material_news_list = material_news_list($server, $search, array('page_index' => $page_index, 'page_size' => $page_size));
	} else {
		if (empty($server)) {
			$server = MATERIAL_WEXIN;
		}
		$material_news_list = material_list($type, $server, array('page_index' => $page_index, 'page_size' => $page_size));
	}
	$material_list = $material_news_list['material_list'];
	$pager = $material_news_list['page'];
	template('platform/material');
}

if ('detail' == $do) {
	$type = safe_gpc_string($_GPC['type']);
	$newsid = intval($_GPC['newsid']);
	$attachment = material_get($newsid);
	if (is_error($attachment)) {
		itoast('图文素材不存在，或已删除', url('platform/material'), 'warning');
	}
	$news = $attachment['news'][0];
	template('platform/material-detail');
}

if ('delete' == $do) {

	permission_check_account_user('platform_material_delete');

	if (empty($_W['isfounder']) && ACCOUNT_MANAGE_NAME_MANAGER != $_W['role'] && ACCOUNT_MANAGE_NAME_OWNER != $_W['role'] && ACCOUNT_MANAGE_NAME_OPERATOR != $_W['role']) {
		iajax(1, '您没有权限删除文件');
	}

	if (isset($_GPC['uniacid'])) { //如果强制指定了uniacid
		$requniacid = intval($_GPC['uniacid']);
		attachment_reset_uniacid($requniacid);
	}

	$_GPC['material_id'] = is_array($_GPC['material_id']) ? $_GPC['material_id'] : explode(',', $_GPC['material_id']);
	$material_id = safe_gpc_array($_GPC['material_id']);
	$server = 'local' == safe_gpc_string($_GPC['server']) ? 'local' : 'wechat';
	$type = safe_gpc_string($_GPC['type']);
	$cron_record = pdo_get('mc_mass_record', array('uniacid' => $_W['uniacid'], 'attach_id' => $material_id, 'sendtime >=' => TIMESTAMP), array('id'));
	if (!empty($cron_record)) {
		iajax('-1', '有群发消息未发送，不可删除');
	}
	if (!empty($material_id)) {
		foreach ($material_id as $id) {
			if ('news' == $type) {
				$result = material_news_delete($id);
			} else {
				//TODO 非图文素材整合后去掉server判断
				$result = material_delete($id, $server);
			}
		}
	}
	if (is_error($result)) {
		iajax('-1', $result['message']);
	}
	iajax('0', '删除素材成功');
}

if ('sync' == $do) {
	$account_api = WeAccount::createByUniacid();
	$pageindex = !empty($_GPC['pageindex']) ? intval($_GPC['pageindex']) : 1;
	$type = empty($_GPC['type']) ? 'news' : safe_gpc_string($_GPC['type']);
	$news_list = $account_api->batchGetMaterial($type, ($pageindex - 1) * 20);
	$wechat_existid = empty($_GPC['wechat_existid']) ? array() : safe_gpc_array($_GPC['wechat_existid']);
	if (1 == $pageindex) {
		$original_newsid = pdo_getall('wechat_attachment', array('uniacid' => $_W['uniacid'], 'type' => $type, 'model' => 'perm'), array('id'), 'id');
		$original_newsid = array_keys($original_newsid);
		$wechat_existid = material_sync($news_list['item'], array(), $type);
		if ($news_list['total_count'] > 20) {
			$total = ceil($news_list['total_count'] / 20);
			iajax('1', array('type' => $type, 'total' => $total, 'pageindex' => $pageindex + 1, 'wechat_existid' => $wechat_existid, 'original_newsid' => $original_newsid), '');
		}
	} else {
		$wechat_existid = material_sync($news_list['item'], $wechat_existid, $type);
		$total = intval($_GPC['total']);
		$original_newsid = safe_gpc_array($_GPC['original_newsid']);
		if ($total != $pageindex) {
			iajax('1', array('type' => $type, 'total' => $total, 'pageindex' => $pageindex + 1, 'wechat_existid' => $wechat_existid, 'original_newsid' => $original_newsid), '');
		}
		if (empty($original_newsid)) {
			$original_newsid = array();
		}
		$original_newsid = array_filter($original_newsid, function ($item) {
			return is_numeric($item);
		});
	}
	$delete_id = array_diff($original_newsid, $wechat_existid);
	if (!empty($delete_id) && is_array($delete_id)) {
		foreach ($delete_id as $id) {
			pdo_delete('wechat_attachment', array('uniacid' => $_W['uniacid'], 'id' => $id));
			pdo_delete('wechat_news', array('uniacid' => $_W['uniacid'], 'attach_id' => $id));
		}
	}
	iajax(0, '更新成功！', '');
}
