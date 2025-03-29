# download-from-har

## har ファイルを元に外部サイトの画像をダウンロードする

1. Google Chrome の DevTools で Network タブを表示
2. Filter で Img のみにして .har ファイルをダウンロード(Export HAR をクリック)
3. プロジェクトルートに .har ファイルを設置
4. `$ php index.php ./example.har`
