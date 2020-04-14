<?php

declare(strict_types=1);

namespace CategoryTree\Api;

interface OutputInterface
{
    /**
     * @param $data
     * @return mixed
     */
    public function saveData($data);
}