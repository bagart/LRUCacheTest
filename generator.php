<?php

declare(strict_types=1);
$commands = 20000000;
$rangeMax = 1000000;
$dataFileName = 'data.txt';

$file = fopen($dataFileName, 'w+');


for ($i = 0; $i < $commands; ++$i) {
    $command = $i > 1000 && rand(0, 10) ? 'get' : 'put';
    switch ($command) {
        case 'get':
            fputs($file, '-' . rand(1, $rangeMax) . "\n");
            break;
        case 'put':
            fputs($file, rand(1, $rangeMax) . "\n");
            break;
    }
}
fclose($file);