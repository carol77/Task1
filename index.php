<?php

use CategoryTree\Service\JsonFileLoaderService;
use CategoryTree\Service\FileInputService;
use CategoryTree\Service\OutputService;
use CategoryTree\Resources\JsonFile;
use CategoryTree\Resources\Tree;

require_once 'Loader.php';

$configuration = require_once 'config.php';
$categoryTreeFilePath = $configuration['input_files']['category_tree_file_path'];
$categoryListFilePath = $configuration['input_files']['category_list_file_path'];
$translation = $configuration['lang'];

$fileInput = new FileInputService(new JsonFileLoaderService());
$categoryTree = $fileInput->getData($categoryTreeFilePath);
$categoryList = $fileInput->getData($categoryListFilePath);

$categoryTree = new Tree($categoryTree);
$completedTree = $categoryTree->complete($categoryList, $translation);

$completedCategoryTreeFilePath = $configuration['output_files']['category_tree_file_path'];
$completedCategoryTreeFile = new JsonFile($completedCategoryTreeFilePath);
$fileOutput = new OutputService($completedCategoryTreeFile);
$fileOutput->saveData($completedTree);

echo "It's done!";
