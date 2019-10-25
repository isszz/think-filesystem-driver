<?php
declare (strict_types = 1);

namespace think\filesystem\driver;

use League\Flysystem\AdapterInterface;
use think\filesystem\Driver;

use LogicException;

class Cos extends Driver
{
    /**
     * 配置参数
     * @var array
     */
    protected $config = [
        'cos' => '',
    ];

    protected function createAdapter(): AdapterInterface
    {
        if(!class_exists('\Overtrue\Flysystem\Cos\CosAdapter')) {
            throw new LogicException('Please composer require overtrue/flysystem-cos -vvv');
        }

        return new \Overtrue\Flysystem\Cos\CosAdapter($this->config);
    }
    
    public function addPlugin()
    {
        if(empty($this->filesystem)) {
            throw new LogicException('Filesystem is not initialized');
        }

        return $this->filesystem;
    }
}
