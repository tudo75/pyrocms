<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Navigation Plugin
 *
 * @package		PyroCMS
 * @author		PyroCMS Dev Team
 * @copyright	Copyright (c) 2008 - 2010, PyroCMS
 *
 */
class Plugin_Navigation extends Plugin
{
	/**
	 * News List
	 *
	 * Creates a list of news posts
	 *
	 * Usage:
	 * {pyro:navigation:list group="header"}
	 *
	 * @param	array
	 * @return	array
	 */
	function links()
	{
		$group = $this->attribute('group');
		$tag = $this->attribute('tag', 'li');
		$current_class = $this->attribute('class', 'current');

		$this->load->model('navigation/navigation_m');
		$links = $this->cache->model('navigation_m', 'load_group', array($group), $this->settings->navigation_cache);

		$list = '';

		if ($links)
		{
			foreach ($links as $link)
			{
				$attributes = array('target' => $link->target);

				if (current_url() == $link->url)
				{
					$attributes['class'] = $current_class;
				}
				
				$list .= '<'.$tag.'>' . anchor($link->url, $link->title, $attributes). '</'.$tag.'>'.PHP_EOL;
			}
		}

    	return $list;
	}
}

/* End of file news.plugin.php */