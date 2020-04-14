<?php

spl_autoload_register('loadClass');

function loadClass(string $classname)
{
    if(strpos($classname, 'CategoryTree') === false) {
        return;
    }
    $namespaceParts = explode('\\', $classname);
    $path =  __DIR__.'\\';
    $i = 1;
    while($i < count($namespaceParts)) {
        $path .= $namespaceParts[$i].'\\';
        $i++;
    }
    $path = rtrim($path, '\\');
    $path = str_replace('\\', '/', $path);
    require_once $path.'.php';
}
