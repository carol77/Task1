<?php

declare(strict_types=1);

namespace CategoryTree\Service;

use CategoryTree\Api\OutputInterface;
use CategoryTree\Api\FileInterface;

class OutputService implements OutputInterface
{
    private $file;

    /**
     * @param FileInterface $file
     */
    public function __construct(FileInterface $file)
    {
        $this->file = $file;
    }

    /**
     * @inheritDoc
     */
    public function saveData($data)
    {
        $this->file->saveContent($data);
    }
}