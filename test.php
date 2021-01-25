<?php

declare(strict_types=1);
ini_set('memory_limit', '2048M');

include_once 'LRUCacheContract.php';
include_once 'LRUCacheLinked.php';
include_once 'LRUCacheIndexed.php';

function reader(LRUCacheContract $LRUCache, $dataFileName)
{
    $file = fopen($dataFileName, 'r');
    $start = microtime(true);
    $crc32 = '';
    while (($line = fgets($file, 4096)) !== false) {
        $key = (int)trim($line);

        if ($key > 0) {
            $LRUCache->put($key, $key * 137);
        } else {
            $crc32 = crc32($crc32 . $LRUCache->get(-$key));
        }
    }
    return [
        'class' => get_class($LRUCache),
        'time' => round((microtime(true) - $start), 2) . 'sec',
        'crc32' => $crc32,
        'mem_peak' => round(memory_get_peak_usage()/1024/1024,2) . 'mb',
        'mem_current' => round(memory_get_usage()/1024/1024,2) . 'mb',
        'debug' => $LRUCache->debug(),
    ];
}

$dataFileName = 'data.txt';
$capacity = 500000;

//$indexedResult = reader(new LRUCacheIndexed($capacity), $dataFileName);
//var_dump($indexedResult);

$linkedResult = reader(new LRUCacheLinked($capacity), $dataFileName);
var_dump($linkedResult);

//var_dump(
//    [
//        'LRUCacheLinked = LRUCacheIndexed' => $linkedResult['crc32'] === $indexedResult['crc32']
//    ]
//);