<?php
//1. POSTデータ取得
$id = $_GET["id"];

//１．PHP
//select.phpのPHPコードをマルっとコピーしてきます。
//※SQLとデータ取得の箇所を修正します。
//【重要】
//insert.phpを修正（関数化）してからselect.phpを開く！！

// 2. DB接続します
include("funcs.php");
$pdo = db_conn();

// //３．データ登録SQL作成
$sql = "SELECT * FROM gs_an_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id',$id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

// //４．データ登録処理後
$values = "";
if($status==false){
  sql_error($stmt);
} 

//1行だけデータ取得
$v =  $stmt->fetch(); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]

?>

<!--
２．HTML
以下にindex.phpのHTMLをまるっと貼り付ける！
理由：入力項目は「登録/更新」はほぼ同じになるからです。
※form要素 input type="hidden" name="id" を１項目追加（非表示項目）
※form要素 action="update.php"に変更
※input要素 value="ここに変数埋め込み"
-->

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

  <!-- Main[Start] -->
  <form method="POST" action="update.php">
    <div class="jumbotron">
      <fieldset>
        <legend>疲労回復に繋がった場所・モノ・コトリスト</legend>
        <label>タイトル：<input type="text" name="name" value="<?=$v["name"]?>"></label><br>
        <label>参考URL：<input type="text" name="email "value="<?=$v["email"]?>"></label><br>
        <label>回復につながったpt（〜100）：<input type="text" name="age" value="<?=$v["age"]?>"></label><br>
        <label>メモ・コメント<textArea name="naiyou" rows="4" cols="40"><?=$v["naiyou"]?></textArea></label><br>
        <input type="hidden" name="id" value="<?=$v["id"]?>">
        <input type="submit" value="送信">
      </fieldset>
    </div>
  </form>
  <!-- Main[End] -->

<!-- Foot[Start] -->
<footer>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
      <div class="navbar-header"><a class="navbar-brand" href="select.php">登録データ一覧参照</a></div>
      </div>
    </nav>
  </footer>
<!-- Foot[End] -->
  
</body>
</html>
