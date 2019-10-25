<?php

namespace think\filesystem\driver\qiniu\plugins;

use League\Flysystem\Plugin\AbstractPlugin;

class FileUrl extends AbstractPlugin
{
    public function getMethod()
    {
        return 'getUrl';
    }

    public function handle($path)
    {
        // fix \ = %5C bug
        $path = str_replace('\\', '/', $path);

        return $this->filesystem->getAdapter()->getUrl($path);
    }
}
