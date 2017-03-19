<?php
$stones = explode(",", trim($_GET["rocks"]));

$rocksCount = [];
foreach ($stones as $stone) {
    $stone = array_unique(str_split($stone));
    foreach ($stone as $s) {
        if (!array_key_exists($s, $rocksCount)) {
            $rocksCount[$s] = 0;
        }

        $rocksCount[$s]++;
    }
}

$total = 0;
foreach ($rocksCount as $stone => $count) {
    if ($count === count($stones)) {
        $total++;
    }
}

echo $total;