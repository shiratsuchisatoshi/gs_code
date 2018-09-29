<?php
//1. POSTデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ
$name =$_POST["name"];
$url =$_POST["url"];
$cm =$_POST["cm"];


//2. DB接続します
// include "func.php";
// $pdo=db_con();


// // 毎回同じ書き方(PHPが用意してあるもの)
try {
  $pdo = new PDO('mysql:dbname=gs_db2;charset=utf8;host=localhost','root','');
  // rootはID rootの隣の""はパスワード ＸＡＭＰＰの場合は空白でＯＫ
} catch (PDOException $e) {
  exit('DB_CONECTION_ERROR:'.$e->getMessage());
  // exitの隣のＤＢ＿ＣＯＮＥＣＴＩＯＮ…はエラーが起きたときに表示する文言を入力している。
}


//３．データ登録SQL作成
$sql="INSERT INTO gs_bm_table(book_name,url,cm,indate)VALUES (:name,:url,:cm,sysdate())";

$stmt = $pdo->prepare($sql);
// bindvalueを通すとPOSTデータで危ない文字列を無効化している
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':url', $url, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':cm', $cm, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();
// executeは実行関数。実行した結果(true か false)を$statusの関数に格納している

//４．データ登録処理後
if($status==false){
//   function sqlError($stmt);
//   // function sqlError($stmt){
    $error = $stmt->errorInfo();
    exit("SWL_ERROR:".$error[2]);
  // }
  // //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
 
}else{
  //５．index.phpへリダイレクト
  header("Location: game.php");
  exit;


}
?>
