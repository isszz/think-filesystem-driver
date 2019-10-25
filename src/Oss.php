<?php
declare (strict_types = 1);

namespace think\filesystem\driver;

use League\Flysystem\AdapterInterface;
use think\filesystem\Driver;

use LogicException;

class Oss extends Driver
{
    /**
     * 配置参数
     * @var array
     */
    protected $config = [
        'oss' => '',
    ];

    protected function createAdapter(): AdapterInterface
    {
        if(!class_exists('\Iidestiny\Flysystem\Oss\OssAdapter')) {
            throw new LogicException('Please composer require iidestiny/flysystem-oss -vvv');
        }

        $root = $this->config['root'] ?? null;

        return new \Iidestiny\Flysystem\Oss\OssAdapter(
            $this->config['access_key'],
            $this->config['secret_key'],
            $this->config['domain'],
            $this->config['bucket'],
            $this->config['is_cname'],
            $root
        );
    }

    public function addPlugin()
    {
        if(empty($this->filesystem)) {
            throw new LogicException('Filesystem is not initialized');
        }

        $this->filesystem->addPlugin(new \Iidestiny\Flysystem\Oss\Plugins\FileUrl());
        $this->filesystem->addPlugin(new \Iidestiny\Flysystem\Oss\Plugins\SignUrl());
        $this->filesystem->addPlugin(new \Iidestiny\Flysystem\Oss\Plugins\TemporaryUrl());
        $this->filesystem->addPlugin(new \Iidestiny\Flysystem\Oss\Plugins\SignatureConfig());

        return $this->filesystem;
    }
}
