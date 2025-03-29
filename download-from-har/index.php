<?php
$har = $argv[1] ?? null;
if (\is_null($har)) {
    exit('.har ファイルを指定してください。');
}

$src = \json_decode(\file_get_contents($har), true);

foreach ($src['log']['entries'] as $entry) {
    $url = $entry['request']['url'];
    $img = \file_get_contents($url);
    $fileName = \pathinfo($url, PATHINFO_BASENAME);
    \file_put_contents("./downloads/{$fileName}", $img);
}
