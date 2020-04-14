<?php

declare(strict_types=1);

namespace CategoryTree\Resources;

use CategoryTree\Api\FileInterface;

class JsonFile implements FileInterface
{
    /**
     * @var string
     */
    private $path;

    /**
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * @return false|string
     * @throws \Exception
     */
    public function getContent()
    {
        if(!is_readable($this->path)) {
            throw new \Exception('You do not have permissions to read this file');
        }
        $content = file_get_contents($this->path);
        if($content === false) {
            throw new \Exception('An error occurred during reading file content');
        }
        return json_decode($content);
    }

    /**
     * @param string $data
     * @throws \Exception
     */
    public function saveContent($data)
    {
        $result = file_put_contents($this->path, json_encode($data));
        if($result === false) {
            throw new \Exception('An error occurred during writing to file');
        }
    }
}