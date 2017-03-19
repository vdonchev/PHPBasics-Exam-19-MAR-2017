<?php
$string = trim($_GET["string"]);
$key = intval(trim($_GET["key"]));

$chars = str_split($string);
for ($i = 0; $i < count($chars); $i++) {
    if (preg_match("/[a-zA-Z]/", $chars[$i])) {
        $chars[$i] = rotate($chars[$i], $key);
    }
}

echo implode("", $chars);

function rotate(string $char, int $count): string
{
    // A - 65   a - 97
    // Z - 90   z - 122
    $pos = ord($char);
    for ($i = 0; $i < $count; $i++) {
        $pos += 1;
        if (strtolower($char) === $char) {
            if ($pos > 122) {
                $pos = 97;
            }
        } else {
            if ($pos > 90) {
                $pos = 65;
            }
        }
    }

    return chr($pos);
}