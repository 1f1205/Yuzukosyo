<?php
require_once('./Title2Keyphrase.php');

if ($argc != 3) {
    return 0;
}

$appId = $argv[1];
$title = $argv[2];

// タイトルからKeyphraseを取得
$title2KeyObj = new Title2Keyphrase();
$keyphrases = $title2KeyObj->execute($appId, $title);

// keyphrase表示
foreach ($keyphrases as $keyphrase) {
    echo $keyphrase . "\n";
}
