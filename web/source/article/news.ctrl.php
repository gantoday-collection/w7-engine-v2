<?php
/**
 * 文章/公告---文章管理
 * [WeEngine System] Copyright (c) 2014 W7.CC.
 */
defined('IN_IA') or exit('Access Denied');

$dos = array('category_post', 'category', 'category_del', 'list', 'post', 'batch_post', 'del', 'displaysetting');
$do = in_array($do, $dos) ? $do : 'list';
permission_check_account_user('system_article_news');

//添加分类
if ('category_post' == $do) {
	if ($_W['ispost']) {
		$i = 0;
		if (!empty($_GPC['title'])) {
			foreach ($_GPC['title'] as $k => $v) {
				$title = safe_gpc_string($v);
				if (empty($title)) {
					continue;
				}
				$data = array(
					'title' => $title,
					'displayorder' => intval($_GPC['displayorder'][$k]),
					'type' => 'news',
				);
				pdo_insert('article_category', $data);
				++$i;
			}
		}
		if ($_W['isw7_request']) {
			iajax(0, '添加分类成功');
		}
		itoast('添加分类成功', url('article/news/category'), 'success');
	}
	template('article/news-category-post');
}

//修改分类
if ('category' == $do) {
	$category_table = table('article_category');
	if ($_W['ispost']) {
		$id = intval($_GPC['id']);
		if (empty($id)) {
			iajax(1, '参数有误');
		}
		if (empty($_GPC['title'])) {
			iajax(1, '分类名称不能为空');
		}
		$update = array(
			'title' => safe_gpc_string($_GPC['title']),
			'displayorder' => max(0, intval($_GPC['displayorder'])),
		);
		$category_table->fill($update)->where('id', $id)->save();
		iajax(0, '修改分类成功');
	}

	$data = $category_table->getNewsCategoryLists();
	if ($_W['isw7_request']) {
		iajax(0, $data);
	}
	template('article/news-category');
}

//删除分类
if ('category_del' == $do) {
	$id = intval($_GPC['id']);
	pdo_delete('article_category', array('id' => $id, 'type' => 'news'));
	pdo_delete('article_news', array('cateid' => $id));
	if ($_W['isw7_request']) {
		iajax(0, '删除分类成功');
	}
	itoast('删除分类成功', referer(), 'success');
}

//编辑文章
if ('post' == $do) {
	$id = empty($_GPC['id']) ? 0 : intval($_GPC['id']);
	$new = table('article_news')->searchWithId($id)->get();

	if (empty($new)) {
		$new = array(
			'is_display' => 1,
			'is_show_home' => 1,
		);
	}
	if ($_W['ispost']) {
		$title = safe_gpc_string($_GPC['title']) ? safe_gpc_string($_GPC['title']) : ($_W['isw7_request'] ? iajax(-1, '新闻标题不能为空') : itoast('新闻标题不能为空', '', 'error'));
		$cateid = intval($_GPC['cateid']) ? intval($_GPC['cateid']) : ($_W['isw7_request'] ? iajax(-1, '新闻分类不能为空') : itoast('新闻分类不能为空', '', 'error'));
		$content = !empty($_GPC['content']) ? safe_gpc_html(htmlspecialchars_decode($_GPC['content'], ENT_QUOTES)) : ($_W['isw7_request'] ? iajax(-1, '新闻内容不能为空') : itoast('新闻内容不能为空', '', 'error'));
		$data = array(
			'title' => $title,
			'cateid' => $cateid,
			'content' => $content,
			'source' => safe_gpc_string($_GPC['source']),
			'author' => safe_gpc_string($_GPC['author']),
			'displayorder' => intval($_GPC['displayorder']),
			'click' => intval($_GPC['click']),
			'is_display' => intval($_GPC['is_display']),
			'is_show_home' => intval($_GPC['is_show_home']),
		);
		if (!empty($_GPC['thumb']) && file_is_image(tomedia($_GPC['thumb']))) {
			$data['thumb'] = safe_gpc_url($_GPC['thumb'], false);
		} elseif (!empty($_GPC['autolitpic'])) {
			$match = array();
			preg_match('/attachment\/(.*?)(\.gif|\.jpg|\.png|\.bmp)/', $data['content'], $match);
			if (!empty($match[1])) {
				$data['thumb'] = $match[1] . $match[2];
			}
		} else {
			$data['thumb'] = '';
		}

		if (!empty($new['id'])) {
			pdo_update('article_news', $data, array('id' => $id));
		} else {
			$data['createtime'] = TIMESTAMP;
			pdo_insert('article_news', $data);
		}
		if ($_W['isw7_request']) {
			iajax(0, '编辑成功');
		}
		itoast('编辑文章成功', url('article/news/list'), 'success');
	}

	if ($_W['isw7_request']) {
		iajax(0, $new);
	}
	$categorys = table('article_category')->getNewsCategoryLists();
	template('article/news-post');
}

//新闻列表
if ('list' == $do) {
	$pindex = empty($_GPC['page']) ? 1 : intval($_GPC['page']);
	$psize = 20;

	$article_table = table('article_news');
	$cateid = empty($_GPC['cateid']) ? 0 : intval($_GPC['cateid']);
	$createtime = empty($_GPC['createtime']) ? 0 : intval($_GPC['createtime']);
	$title = empty($_GPC['title']) ? '' : safe_gpc_string($_GPC['title']);

	if (!empty($cateid)) {
		$article_table->searchWithCateid($cateid);
	}

	if (!empty($createtime)) {
		$article_table->searchWithCreatetimeRange($createtime);
	}

	if (!empty($title)) {
		$article_table->searchWithTitle($title);
	}

	$order = !empty($_W['setting']['news_display']) ? $_W['setting']['news_display'] : 'displayorder';

	$article_table->searchWithPage($pindex, $psize);
	$article_table->orderby($order, 'DESC');
	$news = $article_table->getall();
	$categorys = table('article_category')->getNewsCategoryLists($order);
	foreach ($news as $n=>$new) {
		if (!empty($categorys[$new['cateid']])) {
			$news[$n]['catename'] = $categorys[$new['cateid']]['title'];
		} else {
			$news[$n]['catename'] = '';
		}
		
		$news[$n]['createtime'] = date('Y-m-d H:i', $new['createtime']);
		
	}
	$news_display = setting_load('news_display');
	$news_display = !empty($news_display) ? $news_display['news_display'] : 'displayorder';
	$total = $article_table->getLastQueryTotal();
	$pager = pagination($total, $pindex, $psize);
	
	if ($_W['isw7_request']) {
		$message = array(
			'total' => $total,
			'page' => $pindex,
			'page_size' => $psize,
			'list' => $news,
			'news_display' => $news_display
		);
		iajax(0, $message);
	}
	template('article/news');
}

//编辑新闻
if ('batch_post' == $do) {
	if (checksubmit()) {
		if (!empty($_GPC['ids'])) {
			foreach ($_GPC['ids'] as $k => $v) {
				$data = array(
					'title' => safe_gpc_string($_GPC['title'][$k]),
					'displayorder' => intval($_GPC['displayorder'][$k]),
					'click' => intval($_GPC['click'][$k]),
				);
				pdo_update('article_news', $data, array('id' => intval($v)));
			}
			itoast('编辑新闻列表成功', referer(), 'success');
		}
	}
}

//删除文章
if ('del' == $do) {
	$id = intval($_GPC['id']);
	table('article_news')->where(array('id' => $id))->delete();
	if ($_W['isw7_request']) {
		iajax(0, '删除成功');
	}
	itoast('删除文章成功', referer(), 'success');
}

//显示排序设置
if ('displaysetting' == $do) {
	$setting = safe_gpc_string($_GPC['setting']);
	$data = 'createtime' == $setting ? 'createtime' : 'displayorder';
	setting_save($data, 'news_display');
	if ($_W['isw7_request']) {
		iajax(0, '更改成功');
	}
	itoast('更改成功！', referer(), 'success');
}
