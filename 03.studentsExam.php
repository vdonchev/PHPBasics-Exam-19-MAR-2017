<?php
$data = array_map("trim", explode(",", trim($_GET["string"])));
$exams = [];

foreach ($data as $entry) {
    $tokens = explode("-", $entry);

    $name = trim($tokens[0]);
    $tokens = explode(":", $tokens[1]);

    $exam = trim($tokens[0]);
    $score = intval(trim($tokens[1]));

    if ($score < 0 || $score > 400) {
        continue;
    }

    if (!array_key_exists($exam, $exams)) {
        $exams[$exam] = [];
    }

    if (!array_key_exists($name, $exams[$exam])) {
        $exams[$exam][$name] = [-1, -1, $name];
    }

    if ($exams[$exam][$name][0] < $score) {
        $exams[$exam][$name][0] = $score;
    }

    $exams[$exam][$name][1]++;
}

$output = "<table>\n<tr><th>Subject</th><th>Name</th><th>Result</th><th>MakeUpExams</th>\n";
foreach ($exams as $exam => $students) {
    uasort($students, function ($stA, $stB) {
        $res = $stB[0] - $stA[0];
        if ($res === 0) {
            $res = $stA[1] - $stB[1];

            if ($res === 0) {
                $res = $stA[2] <=> $stB[2];
            }
        }

        return $res;
    });

    foreach ($students as $studentName => $studentData) {
        $output .= "<tr><td>{$exam}</td><td>{$studentName}</td><td>{$studentData[0]}</td><td>{$studentData[1]}</td></tr>\n";
    }
}

$output .= "</table>";

echo $output;