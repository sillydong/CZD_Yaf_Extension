<?php
/**
 * chenzhidong
 * 2013-5-11
 */

class Pagination {
	const TYPE_PARAM=1; /** /1 */
	const TYPE_ENTITY=2; /** &page=1 */
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
		$pagination_info['page_type'] = $type;
		$pagination_info['page_total'] = $total;
		$pagination_info['page_current'] = $current;
		$pagination_info['page_prev'] = $current - 1;
		$pagination_info['page_next'] = $current + 1;
		$pagination_info['page_per'] = $count;
		$pagination_info['page_gap'] = 3;

		/*
		$prefix=Tools::getHttpHost(true).substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '?')).'?';
		$queries=array_merge($_POST,$_GET);
		foreach ($queries as $key=>$query){
			if($key!='p'){
				$prefix.=$key.'='.$query.'&';
			}
		}
		*/
		$pagination_info['page_prefix'] = $prefix;

		$page_count = (int) ceil($total / $count);
		$pagination_info['page_count'] = $page_count;

		$page_start = (int) $current - $gap;
		$page_start = ($page_start < 1 ? 1 : $page_start);
		$pagination_info['page_start'] = $page_start;

		$page_stop = (int) $current + $gap;
		$page_stop = ($page_stop > $page_count ? $page_count : $page_stop);
		$pagination_info['page_stop'] = $page_stop;

		$view->assign('pagination_info', $pagination_info);
		return $pagination_info;
	}
}
