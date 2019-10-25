<?php

namespace think\filesystem\driver\qiniu\plugins;

use League\Flysystem\Plugin\AbstractPlugin;

class RefreshFile extends AbstractPlugin
{
    public function getMethod()
    {
        return 'refresh';
    }

    public function handle($path = [])
    {
        // fix \ = %5C bug
        if (is_string($path)) {
            $path = str_replace('\\', '/', $path);
        } elseif(is_array($path)) {
            foreach($path as $key => $value) {
                $path[$key] = str_replace('\\', '/', $value);
            }
        }

        return $this->filesystem->getAdapter()->refresh($path);
    }
}
