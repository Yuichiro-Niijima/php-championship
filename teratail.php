<?php
// ini_set('display_errors', 1);
// error_reporting(E_ALL);

session_start();
include("functions.php");
check_session_id();

// ユーザ名取得
$user_id = $_SESSION['id'];

// DB接続
$pdo = connect_to_db();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty(filter_input(INPUT_POST, 'student_name'))) {
        $name = filter_input(INPUT_POST, 'student_name');
        try {

            // $pdo = new PDO('mysql:dbname=php_ championship;charset=utf8;port=3306;host=localhost', 'root', 'password');
            $stmt = $pdo->prepare('SELECT * FROM info_table WHERE `student_name` = :student_name');
            $stmt->bindParam(':student_name', $student_name);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            echo $exception->getMessage();
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <title>タイトル</title>
</head>

<body>
    <form action='' method='post'>
        <label>
            <input type='text' name='student_name'>
        </label>
        <input type='submit'>
    </form>
    <div id="result">
        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') { ?>
            <?php if (empty($result)) { ?>
                <strong>該当する結果はなし。</strong>
            <?php } else { ?>
                <ol>
                    <?php foreach ($result as &$value) { ?>
                        <li><?php echo htmlspecialchars($value['id'], ENT_QUOTES, 'UTF-8') . " : " . htmlspecialchars($value['student_name'], ENT_QUOTES, 'UTF-8') ?></li>
                    <?php } ?>
                </ol>
            <?php } ?>
        <?php } ?>
    </div>
</body>

</html>