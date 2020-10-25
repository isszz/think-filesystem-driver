<?php

return [
   'disks' => [
		// 七牛配置
		'qiniu' => [
			'type'       => 'qiniu',
			'access_key' => env('qiniu.access_key', 'xxxxxxxxxxxxxxxx'),
			'secret_key' => env('qiniu.secret_key', 'xxxxxxxxxxxxxxxx'),
			'bucket'     => env('qiniu.bucket', 'test'),
			'domain'     => env('qiniu.domain', 'xxx.xxx.top'), // or host: https://xxxx.xxx.top
		],
		// 阿里 oss 配置
		'oss' => [
			'type'       => 'oss',
			'access_key' => env('oss.access_key', 'xxxxxxxxxxxxxxxx'),
			'secret_key' => env('oss.secret_key', 'xxxxxxxxxxxxxxxx'),
			'bucket'     => env('oss.bucket', 'test'),
			'domain'     => env('oss.domain', 'xxx.xxx.top'), // ssl：https://xxxx.xxx.top
			'is_cname'   => env('oss.is_cname', false), // 如果 is_cname 为 false, domain 应配置 oss 提供的域名如：`oss-cn-beijing.aliyuncs.com`，cname 或 cdn 请自行到阿里 oss 后台配置并绑定 bucket
			'root'       => env('oss.root', ''), // 前缀，非必填
		],
		// 腾讯 cos 配置
		'cos' => [
			'type'			  => 'cos',
			'region'          => env('cos.region', 'ap-shanghai'), // 地域
			'credentials'     => [
				'appId'		  => env('cos.app_id'), // 域名中数字部分
				'secretId'	  => env('cos.secret_id'),
				'secretKey'	  => env('cos.secret_key'),
			],
			'bucket'          => env('cos.bucket'),
			'cdn'             => env('cos.cdn'), // CDN 域名
			'scheme'          => env('cos.scheme', 'https'),
			'read_from_cdn'   => env('cos.read_from_cdn', false),
			'timeout'         => env('cos.timeout', 60),
			'connect_timeout' => env('cos.connect_timeout', 60),
		],
		// ...
   ]
];
