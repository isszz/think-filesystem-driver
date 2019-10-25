<?php

namespace think\filesystem\driver\qiniu\plugins;

use League\Flysystem\Plugin\AbstractPlugin;

class PrivateDownloadUrl extends AbstractPlugin
{
    public function getMethod()
    {
        return 'privateDownloadUrl';
    }

    public function handle($path, $expires = 3600)
    {
        // fix \ = %5C bug
        $path = str_replace('\\', '/', $path);

        return $this->filesystem->getAdapter()->privateDownloadUrl($path, $expires);
    }
}
