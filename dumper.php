<?php
header("Refresh: 1");
    $lines = file('connection/varDump.txt');
    $lines = array_reverse($lines);

    foreach ($lines as $line) {
        echo $line;
        echo "<br>";
    }
?>