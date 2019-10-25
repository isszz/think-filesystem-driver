<?php
declare (strict_types = 1);

namespace think\filesystem\driver;

use League\Flysystem\AdapterInterface;
use think\filesystem\Driver;

use LogicException;

class Qiniu extends Driver
{
    /**
     * 配置参数
     * @var array
     */
    protected $config = [
        'qiniu' => '',
    ];

    protected function createAdapter(): AdapterInterface
    {
        if(!class_exists('\Overtrue\Flysystem\Qiniu\QiniuAdapter')) {
            throw new LogicException('Please composer require overtrue/flysystem-qiniu -vvv');
        }

        return new \Overtrue\Flysystem\Qiniu\QiniuAdapter(
            $this->config['access_key'],
            $this->config['secret_key'],
            $this->config['bucket'],
            $this->config['domain']
        );
    }
    
    public function addPlugin()
    {
        if(empty($this->filesystem)) {
            throw new LogicException('Filesystem is not initialized');
        }

        $this->filesystem->addPlugin(new \Overtrue\Flysystem\Qiniu\Plugins\FetchFile());
        $this->filesystem->addPlugin(new \Overtrue\Flysystem\Qiniu\Plugins\UploadToken());
        $this->filesystem->addPlugin(new \think\filesystem\driver\qiniu\plugins\FileUrl());
        $this->filesystem->addPlugin(new \think\filesystem\driver\qiniu\plugins\RefreshFile());
        $this->filesystem->addPlugin(new \think\filesystem\driver\qiniu\plugins\PrivateDownloadUrl());

        return $this->filesystem;
    }
}
