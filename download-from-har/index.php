<?php
$har = $argv[1] ?? null;
if (\is_null($har)) {
    exit('第一引数に .har ファイルを指定してください。');
}

$extFromMimeType = function ($mimeType) {
    return match ($mimeType) {
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/gif' => 'gif',
        default => null,
    };
};

$src = \json_decode(\file_get_contents($har), true);

foreach ($src['log']['entries'] as $entry) {
    $url = $entry['request']['url'];
    $img = \file_get_contents($url);
    $info = \pathinfo($url);
    $ext = $info['extension'] ?? null;
    // クエリパラメータ対策
    if (!is_null($ext)) {
        $ext = explode('?', $ext)[0];
    }
    // ファイル情報に拡張子がない場合は header から取得する
    if (\is_null($ext)) {
        $headers = \get_headers($url, 1);
        $ext = $extFromMimeType($headers['Content-Type']);
    }
    $fileName = "{$info['filename']}.{$ext}";

    \file_put_contents("./downloads/{$fileName}", $img);
}
