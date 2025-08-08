<?php

namespace Rhymix\Modules\Allbandazole\Controllers;

use Rhymix\Framework\Exception;
use Rhymix\Framework\Filters\IpFilter;
use Rhymix\Modules\Allbandazole\Models\Blacklist as BlacklistModel;
use Rhymix\Modules\Allbandazole\Models\Config as ConfigModel;
use Context;

/**
 * 구충제 모듈
 *
 * Copyright (c) POESIS
 *
 * Generated with https://www.poesis.org/tools/modulegen/
 */
class Admin extends Base
{
	/**
	 * 초기화
	 */
	public function init()
	{
		// 관리자 화면 템플릿 경로 지정
		$this->setTemplatePath($this->module_path . 'views/admin/');
	}

	/**
	 * 관리자 설정 화면 예제
	 */
	public function dispAllbandazoleAdminConfig()
	{
		// 현재 설정 상태 불러오기
		$config = ConfigModel::getConfig();

		// 기본값 채워넣기
		if (!isset($config->enabled))
		{
			$config->enabled = false;
		}
		if (!isset($config->user_agents))
		{
			$config->user_agents = BlacklistModel::USER_AGENTS;
			$config->user_agents_regexp = self::generateRegexp($config->user_agents);
		}
		if (!isset($config->ip_blocks))
		{
			$config->ip_blocks = BlacklistModel::IP_BLOCKS;
		}
		}
        if (!isset($config->geoip_blocks))
        {
            $config->geoip_blocks = BlacklistModel::GEOIP_BLOCKS;
        }

		// Context에 세팅
		Context::set('config', $config);

		// 스킨 파일 지정
		$this->setTemplateFile('config');
	}

	/**
	 * 관리자 설정 저장 액션 예제
	 */
	public function procAllbandazoleAdminInsertConfig()
	{
		// 현재 설정 상태 불러오기
		$config = ConfigModel::getConfig();

		// 제출받은 데이터 불러오기
		$vars = Context::getRequestVars();
		$config->enabled = $vars->enabled === 'Y';
		$config->user_agents = array_filter(array_map('trim', explode("\n", trim($vars->user_agents))), function($str) {
			return $str !== '';
		});
		$config->user_agents_regexp = self::generateRegexp($config->user_agents);
		$config->ip_blocks = array_filter(array_map('trim', explode("\n", trim($vars->ip_blocks))), function($str) {
			return $str !== '';
		});

		// 현재 접속자가 차단될 수 있는지 확인
		if ($config->user_agents_regexp && preg_match($config->user_agents_regexp, $_SERVER['HTTP_USER_AGENT'] ?? ''))
		{
			throw new Exception('msg_allbandazole_your_user_agent');
		}
		if ($config->ip_blocks && IpFilter::inRanges(\RX_CLIENT_IP, $config->ip_blocks))
		{
			throw new Exception('msg_allbandazole_your_ip_block');
		}

		// 변경된 설정을 저장
		$output = ConfigModel::setConfig($config);
		if (!$output->toBool())
		{
			return $output;
		}

		// 설정 화면으로 리다이렉트
		$this->setMessage('success_registed');
		$this->setRedirectUrl(Context::get('success_return_url'));
	}

	/**
	 * User-Agent 정규식 작성
	 *
	 * @param array $user_agents
	 * @return string
	 */
	public static function generateRegexp(array $user_agents): string
	{
		if (!count($user_agents))
		{
			return '';
		}

		$encoded_user_agents = array_map(function($str) {
			return preg_quote($str, '/');
		}, $user_agents);
		return sprintf('/\\b(%s)\\b/', implode('|', $encoded_user_agents));
	}
}
