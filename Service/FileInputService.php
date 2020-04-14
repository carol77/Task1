<?php

declare(strict_types=1);

namespace CategoryTree\Service;

use CategoryTree\Api\FileInputInterface;
use CategoryTree\Api\FileLoaderInterface;

class FileInputService implements FileInputInterface
{
    /**
     * @var FileLoaderInterface
     */
    private $fileLoader;

    /**
     * @param FileLoaderInterface $fileLoader
     */
    public function __construct(FileLoaderInterface $fileLoader)
    {
        $this->fileLoader = $fileLoader;
    }

    /**
     * @inheritDoc
     */
    public function getData(string $filePath)
    {
        $file = $this->fileLoader->load($filePath);
        return $file->getContent();
    }
}