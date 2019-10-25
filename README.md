<h1 align="center">Thinkphp filesystem 驱动, 本组件需要按需自行安装依赖</h1>

# 安装, 请选择安装依赖组件

### 七牛依赖基础组件
```shell
composer require overtrue/flysystem-qiniu -vvv
```

### 阿里云 oss 依赖基础组件
```shell
composer require iidestiny/flysystem-oss -vvv
```

### 腾讯 cos 依赖基础组件
```shell
composer require overtrue/flysystem-cos -vvv
```


### 本组件
```shell
composer require overtrue/think-filesystem-driver -vvv
```

# 配置

在 config/filesystem.php 的 disks 里新增以下配置

```php
<?php

use think\facade\Env;

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
```

## 基础用法 qiniu, oss, cos 并无差别

```php

use think\facade\Filesystem;

$disk = Filesystem::disk('qiniu');
// $disk = Filesystem::disk('oss');
// $disk = Filesystem::disk('cos');

// 按需引入插件, cos暂时无用
$disk->addPlugin();

$file = request()->file('file');

$filepath = $disk->putFile('mypath', $file);

// 插件提供的url获取
$url = $disk->getUrl($filepath);

dd([$filepath, $url]); 
```

## html

```html
<form action="{{ url('index/upload') }}" method="post" enctype="multipart/form-data">
    <input type="file" name="file">
    <button type="submit">上传</button>
</form>
```


- 查看七牛更多用法: [overtrue/flysystem-qiniu](https://github.com/overtrue/flysystem-qiniu)
- 查看OSS更多用法: [iidestiny/flysystem-oss](https://github.com/iidestiny/flysystem-oss)
- 查看COS更多用法: [overtrue/flysystem-cos](https://github.com/overtrue/flysystem-cos)
- 查看Flysystem API: [http://flysystem.thephpleague.com/api/](http://flysystem.thephpleague.com/api/)
