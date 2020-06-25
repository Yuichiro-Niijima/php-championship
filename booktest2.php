<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

    session_start();
    include("functions.php");
    check_session_id();

    // ユーザ名取得
    $user_id = $_SESSION['id'];

    // DB接続
    $pdo = connect_to_db();

    $student_name = '%' . $_POST['student_name'] . '%';


    try {
        $sql = 'SELECT * FROM info_table WHERE student_name like :student_name';
        $stmh = $pdo->prepare($sql);
        $stmh->bindValue(':student_name', $student_name, PDO::PARAM_STR);
        $stmh->execute();
        $count = $stmh->rowCount();
        // print "検索結果は" . $count . "件です。";
    } catch (PDOException $Exception) {
        print "エラー:" . $Exception->getMessage();
    }



    // 実験
    if ($count < 1) {
        print " 検索結果がありません";
    } else {


        $result = $stmh->fetch(PDO::FETCH_ASSOC);

        var_dump($result);



        $output1 = "";
        $output2 = "";
        $output3 = "";
        $output4 = "";
        $output5 = "";
        $output6 = "";
        $output7 = "";
        $output8 = "";

        while ($row = $stmh->fetch(PDO::FETCH_ASSOC)) {
 
        }
    }
    ?>





    <p> 以下</p>
    <p> <?=$result["student_name"]?></p>

    <?=$output1?>
    <?=$output2?>







</body>

</html>