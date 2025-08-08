<?php

namespace Rhymix\Modules\Allbandazole\Controllers;

use Rhymix\Framework\Filters\IpFilter;
use Rhymix\Modules\Allbandazole\Models\Config as ConfigModel;

/**
 * 구충제 모듈
 *
 * Copyright (c) POESIS
 *
 * Generated with https://www.poesis.org/tools/modulegen/
 */
class EventHandlers extends Base
{
	/**
	 * moduleHandler.init 시점에 실행
	 */
	public function beforeModuleInit($obj)
	{
		$config = ConfigModel::getConfig();
		if (empty($config->enabled))
		{
			return;
		}

		$user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
		if ($user_agent && $config->user_agents_regexp && preg_match($config->user_agents_regexp, $user_agent))
		{
			return $this->_block();
		}

		$ip = \RX_CLIENT_IP;
		if ($config->ip_blocks && IpFilter::inRanges($ip, $config->ip_blocks))
		{
			return $this->_block();
		}

		$geoip =$_SERVER['GEOIP_COUNTRY_CODE'] ?? '' ;
        if ($config->geoip_blocks && extension_loaded('geoip') )
        {
               if(in_array($geoip, $config->geoip_blocks))
               {
                   return $this->_block();
               }
        }

	}

	/**
	 * 차단!
	 */
	protected function _block()
	{
		header('HTTP/1.1 403 Forbidden');
		while (ob_get_level())
		{
			ob_end_clean();
		}

		$type = ($_SERVER['SERVER_SOFTWARE'] ?? '') === 'nginx' ? 'nginx' : 'apache';
		$template = $this->module_path . 'views/blocked/' . $type . '.html';
		readfile($template);
		exit();
	}
}
