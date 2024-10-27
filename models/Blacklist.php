<?php

namespace Rhymix\Modules\Allbandazole\Models;

/**
 * 기본 블랙리스트
 */
class Blacklist
{
	/**
	 * User-Agent
	 */
	public const USER_AGENTS = [
		'Adsbot',
		'AhrefsBot',
		'AI2Bot',
		'Amazonbot',
		'anthropic-ai',
		'Applebot',
		'Arachni',
		'BaiduSpider',
		'Barkrowler',
		'bbot',
		'BLEXBot',
		'brands-bot',
		'Bytedance',
		'Bytespider',
		'CCBot',
		'ChatGPT-User',
		'Claude-Web',
		'ClaudeBot',
		'cohere-ai',
		'ComVoy',
		'CriteoBot',
		'dataforseo-bot',
		'Diffbot',
		'DotBot',
		'Exabot',
		'Eyeotabot',
		'FacebookBot',
		'FriendlyCrawler',
		'GPTBot',
		'GrapeshotCrawler',
		'heritrix',
		'iaskspider',
		'ICC-Crawler',
		'ImagesiftBot',
		'img2dataset',
		'integralads',
		'ISSCyberRiskCrawler',
		'Kangaroo Bot',
		'LieBaoFast',
		'MegaIndex',
		'Meta-ExternalAgent',
		'Meta-ExternalFetcher',
		'MicroMessenger',
		'MJ12bot',
		'OAI-SearchBot',
		'omgili',
		'omgilibot',
		'PerplexityBot',
		'PetalBot',
		'PhantomJS',
		'Scrapy',
		'SemrushBot',
		'serpstatbot',
		'Sidetrade indexer bot',
		'Timpibot',
		'TinyTestBot',
		'Turnitin',
		'UCBrowser',
		'VelenPublicWebCrawler',
		'Webzio-Extended',
		'YouBot',
	];

	/**
	 * IP Blocks
	 */
	public const IP_BLOCKS = [
		'222.239.104.0/24',
	];
}
