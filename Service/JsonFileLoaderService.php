<?php

declare(strict_types=1);

namespace CategoryTree\Service;

use CategoryTree\Resources\JsonFile;
use CategoryTree\Api\FileLoaderInterface;
use CategoryTree\Api\FileInterface;

class JsonFileLoaderService implements FileLoaderInterface
{
    /**
     * @inheritDoc
     */
    public function load(string $filePath): FileInterface
    {
        $fileInfo = pathinfo($filePath);
        if(strtolower($fileInfo['extension']) !== 'json') {
            throw new \Exception('Incorrect file extension');
        }
        return new JsonFile($filePath);
    }
}