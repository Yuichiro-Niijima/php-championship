<?php
// var_dump($_POST);
// exit();

session_start();
include("functions.php");
check_session_id();

// if (
//     !isset($_POST['todo']) || $_POST['todo'] == '' ||
//     !isset($_POST['deadline']) || $_POST['deadline'] == ''
// ) {
//     // 項目が入力されていない場合はここでエラーを出力し，以降の処理を中止する
//     echo json_encode(["error_msg" => "no input"]);
//     exit();
// }

// 受け取ったデータを変数に入れる
// $todo = $_POST['todo'];
// $deadline = $_POST['deadline'];


// ここからファイルアップロード&DB登録の処理を追加しよう！！！
// ---------------------------------
//             画像
// ---------------------------------
// var_dump($_FILES);
// exit();

if (isset($_FILES['upfile']) && $_FILES['upfile']['error'] == 0) {
    // 送信が正常に行われたときの処理 ...
    $uploadedFileName = $_FILES['upfile']['name'];
    $tempPathName = $_FILES['upfile']['tmp_name']; //tmpフォルダの場所 
    $fileDirectoryPath = 'upload/';
    $extension = pathinfo($uploadedFileName, PATHINFO_EXTENSION);
    $uniqueName = date('YmdHis') . md5(session_id()) . "." . $extension;
    $fileNameToSave = $fileDirectoryPath . $uniqueName;
    // var_dump($fileNameToSave);

    $img = '';
    if (is_uploaded_file($tempPathName)) {
        if (move_uploaded_file($tempPathName, $fileNameToSave)) {
            chmod($fileNameToSave, 0644);
            $img = '<img src="' . $fileNameToSave . '" >';
        } else {
            exit('Error:アップロードできませんでした');
            // 権限の変更 // imgタグを設定
            // 画像の保存に失敗 exit('Error:画像がありません'); // tmpフォルダにデータがない
        }
    } else {
        exit("画像がないです。");
    }
} else {
    // 送られていない，エラーが発生，などの場合
    exit('Error:画像が送信されていません');
}

// ---------------------------------
//             画像   以上
// ---------------------------------
// DB接続
$pdo = connect_to_db();

// データ登録SQL作成
// `created_at`と`updated_at`には実行時の`sysdate()`関数を用いて実行時の日時を入力する
$sql = 'INSERT INTO
todo_table(id, todo, deadline, image, created_at, updated_at) VALUES(NULL, :todo, :deadline, :image, sysdate(), sysdate())';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':todo', $todo, PDO::PARAM_STR);
$stmt->bindValue(':deadline', $deadline, PDO::PARAM_STR);
$stmt->bindValue(':image', $fileNameToSave, PDO::PARAM_STR);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
    header("Location:todo_input.php");
    exit();
}
