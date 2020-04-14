<?php

declare(strict_types=1);

namespace CategoryTree\Api;

interface FileInputInterface
{
    /**
     * @param string $filePath
     * @return mixed
     */
    public function getData(string $filePath);
}