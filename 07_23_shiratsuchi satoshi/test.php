<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <title></title>
    </head>
<body>

    <?php
        // エラーを非表示
        error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);
    ?>

<!--検索結果をテーブルで表示 -->
<table border=1> 
    <br>
    <p>検索結果</p>
    <tr>
        <th>登録ボタン</th><th>書籍</th><th>url</th><th>コメント</th>
    </tr>
   

    <form method='post' action='insert.php'>


        <?php
        // 検索結果の変数を受け取る
        $author=$_POST["author"];
        // グーグルbooks APIで検索をかける変数に代入
        $data = "https://www.googleapis.com/books/v1/volumes?&maxResults=40&q=".$author;

        $json = file_get_contents($data);// 検索結果をファイルゲットコンテンツで取得しする
        $json_decode = json_decode($json, true);// 配列化
        //配列化したものをforeach関数で1行づつ繰り返し処理
        foreach($json_decode['items'] as $item){
            $title = $item['volumeInfo']['title']; //itemsのタイトルを変数へ
            $link = $item['volumeInfo']['canonicalVolumeLink']; //itemsのurlを変数へ
            $des = $item['volumeInfo']['description']; //itemsのコメントを変数へ
                echo "<tr>\n";//1行づつの繰り返し処理をテーブルの1行づつに登録する
                //★修正要★ 登録ボタン押下したものだけをＳＱＬに飛ばしたいが一番下のものしか行かない！！
                echo "<td><label><input type='submit' value='登録'></label></td>\n";
                echo "<td width='300'><input readonly style=border:none size='30' type='text' name='name' value=$title></td>\n";
                echo "<td width='50'><input readonly style=border:none size='100' type='text' name='url' value=$link></td>\n";
                echo "<td width='300'><input readonly style=border:none size='100' type='text' name='cm' value=$des></td>\n";
                echo "</tr>\n";   
            }
        ?>
    </form>

</table>
<br>

</body>
</html>
