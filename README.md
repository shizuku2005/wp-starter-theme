# Wordpressをサクッと作るための独自テーマ
いわゆるスターターテーマです。
このリポジトリは、制作者の武田が、自身の運営するITスクールで教材として使用する為に作ったものです。 オープンにすることで、スクール以外の方にも有効に使ってもらえるようにしています。
初心者が使うことを想定しているので、このREADME各ファイル、それぞれのファイルには細かいメモや説明などが記載されていることがあります。基本的にフリーなものですが、このリポジトリ自体を使った商用的な利用や、２次配布などはやめてください。

製作者Webページ https://kazuma-takeda.com/
製作者SNS https://twitter.com/pianojazz2012

## ファイル構成について
- Wordpressを構築する上で、必要だと思われるものを一通り揃えました。あとは、作っていくページなどに合わせてカスタマイズしていってください。
- `style.css`と`script.js`と`img/`は基本的に`app/src`配下の各ディレクトリから出力しています。gulpで構成していますが、この辺も自由にカスタマイズしてください。gulpなどのファイル群に関しては、こちらのリポジトリが最新です → https://github.com/shizuku2005/gulp-pug-sass/tree/feature/use-stylus
- 初期スタイル(CSS)は`app/src/stylus/modules/module.styl`に記載してあるので、消すなりカスタマイズするなりしてください。
- `functions.php`はファイルを分割して読み込ませていて、`functions`ディレクトリ配下から、それぞれ読み込ませています。
- カスタム投稿機能を実装しています。`functions/posts.php`,`single-information.php`などのファイルが関連ファイルとなります。

## メタタグ・OGPタグについて
- descriptionはカスタムフィールドで`description`を設定した場合に、任意のものが設定できるようになっています。
- サイトのOGPイメージ、favicon、appletouchiconなどについては、`functions/ogp.php`に任意の値が入れられるようになっているので、設定してください。各挙動については、ソースを確認してください。

