<?php

declare(strict_types=1);

namespace CategoryTree\Resources;

class Tree
{
    /**
     * @var array
     */
    private $tree;

    /**
     * @var array
     */
    private static $cache = [];

    /**
     * @param array $tree
     */
    public function __construct(array &$tree)
    {
        $this->tree = $tree;
    }

    /**
     * @param array $categoryList
     * @param string $translation
     * @param bool $forceReload
     * @return array
     */
    public function complete(array $categoryList, string $translation, bool $forceReload = false)
    {
        if(empty(self::$cache) || $forceReload) {
            $this->warmCache($this->tree);
        }
        foreach ($categoryList as $category) {
            $this->addNameProperty($this->tree, $category, $translation);
        }
        return $this->tree;
    }

    /**
     * @param array $tree
     * @return mixed
     */
    public function warmCache(array $tree)
    {
        usort($tree, array($this,'sortNodes'));
        foreach ($tree as $node) {
            if (!empty($node->children)) {
                $max = $this->warmCache($node->children);
                self::$cache[$node->id] = $max;
                $maxes[] = $max;
            } else {
                $maxes[] = $node->id;
            }
        }
        return max($maxes);
    }

    /**
     * @param $firstNode
     * @param $secondNode
     * @return int
     */
    private function sortNodes($firstNode, $secondNode)
    {
        if ($firstNode->id == $secondNode->id) {
            return 0;
        }
        return ($firstNode->id < $secondNode->id) ? -1 : 1;
    }

    public function addNameProperty($tree, $category, $translation)
    {
        foreach ($tree as $key => $node) {
            if($node->id === (int)$category->category_id) {
                if(isset($category->translations->{$translation})) {
                    $tree[$key]->name = $category->translations->{$translation}->name;
                } else {
                    $tree[$key]->name = '';
                }
            }
            elseif (((int)$category->category_id > $node->id) && isset(self::$cache[$node->id]) &&
                ((int)$category->category_id <= self::$cache[$node->id])) {
                $node = $this->addNameProperty($node->children, $category, $translation);
            }
        }
    }
}