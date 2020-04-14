<?php

declare(strict_types=1);

namespace CategoryTree\Api;

interface FileInterface
{
    /**
     * @return mixed
     */
    public function getContent();

    /**
     * @param $data
     * @return mixed
     */
    public function saveContent($data);
}