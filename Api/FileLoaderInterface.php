<?php

declare(strict_types=1);

namespace CategoryTree\Api;

use CategoryTree\Api\FileInterface;

interface FileLoaderInterface
{
    /**
     * @param string $filePath
     * @return FileInterface
     */
    public function load(string $filePath): FileInterface;
}