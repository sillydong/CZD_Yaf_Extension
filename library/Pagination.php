<?php
/**
 * chenzhidong
 * 2013-5-11
 */

class Pagination {
	const TYPE_PARAM=1; /** /1 */
	const TYPE_ENTITY=2; /** &p=1 */
	const TYPE_DETAIL=3; /** /page/1 */

	/**
	 * 生成分页
	 * @param $type
	 * @param $view
	 * @param $prefix
	 * @param $total
	 * @param $current
	 * @param $count
	 * @param int $gap
	 * @return mixed
	 */
	public static function splite($type, $view, $prefix, $total, $current, $count, $gap = 3) {
		$current = ($current > 0 ? $current : 1);
		$pagination_info['type'] = $type;
		$pagination_info['total'] = $total;
		$pagination_info['current'] = $current;
		$pagination_info['prev'] = $current - 1;
		$pagination_info['next'] = $current + 1;
		$pagination_info['per'] = $count;
		$pagination_info['gap'] = 3;
		if(!empty($_GET)){
			if($type==Pagination::TYPE_ENTITY && isset($_GET['p']))
				unset($_GET['p']);
			$pagination_info['query']='?'.implode('&',$_GET);
		}
		else
			$pagination_info['query']='';

		$pagination_info['prefix'] = $prefix;

		$page_count = (int) ceil($total / $count);
		$pagination_info['count'] = $page_count;

		$page_start = (int) $current - $gap;
		$page_start = ($page_start < 1 ? 1 : $page_start);
		$pagination_info['start'] = $page_start;

		$page_stop = (int) $current + $gap;
		$page_stop = ($page_stop > $page_count ? $page_count : $page_stop);
		$pagination_info['stop'] = $page_stop;

		$view->assign('pager', $pagination_info);
		return $pagination_info;
	}
}
