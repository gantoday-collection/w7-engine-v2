<?php
/**
 * ip白名单
 * [WeEngine System] Copyright (c) 2014 W7.CC.
 */
defined('IN_IA') or exit('Access Denied');

load()->model('site');
load()->model('setting');

$dos = array('display', 'change_status', 'add', 'delete');
$do = !empty($_GPC['do']) && in_array($_GPC['do'], $dos) ? $_GPC['do'] : 'display';

$ip_lists = setting_load('ip_white_list');
$ip_lists = $ip_lists['ip_white_list'];
if ('display' == $do) {
	$keyword = empty($_GPC['keyword']) ? '' : safe_gpc_string($_GPC['keyword']);
	$lists = $ip_lists;
	if (!empty($keyword)) {
		$lists = array();
		foreach ($ip_lists as $ip => $ip_info) {
			if (strexists($ip, $keyword)) {
				$lists[$ip] = $ip_info;
			}
		}
	}
	if ($_W['isajax']) {
		$message = array(
			'lists' => $lists
		);
		iajax(0, $message);
	}
}

if ('change_status' == $do) {
	$ip = safe_gpc_string($_GPC['ip']);
	$status = $ip_lists[$ip]['status'];
	$status = empty($status) ? 1 : 0;
	$ip_lists[$ip]['status'] = $status;
	$update = setting_save($ip_lists, 'ip_white_list');
	if ($update) {
		iajax(0, '');
	}
	iajax(-1, '更新失败', url('system/ipwhitelist'));
}

if ('add' == $do) {
	$ips = safe_gpc_string($_GPC['ips']);
	$ip_data = site_ip_add($ips);
	if (is_error($ip_data)) {
		iajax(-1, $ip_data['message']);
	}
	iajax(0, '添加成功', url('system/ipwhitelist'));
}

if ('delete' == $do) {
	$ip = safe_gpc_string($_GPC['ip']);
	if (empty($ip)) {
		if ($_W['isajax']) {
			iajax(-1, '参数错误');
		}
		itoast('参数错误');
	}
	unset($ip_lists[$ip]);
	$update = setting_save($ip_lists, 'ip_white_list');
	if ($_W['isajax']) {
		iajax(0, '删除成功');
	}
	itoast('删除成功', url('system/ipwhitelist'));
}
template('system/ip-list');
