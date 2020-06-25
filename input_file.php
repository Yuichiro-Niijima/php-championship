<?php
session_start();
include("functions.php");
check_session_id();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DB連携型todoリスト（入力画面）</title>
</head>

<body>
    <form action="create_file.php" method="POST" enctype="multipart/form-data">
        <fieldset>
        
            <div>
                image: <input type="file" name="upfile" accept="image/*" capture="camera">
            </div>
            <div>
                <button>submit</button>
            </div>
        </fieldset>
    </form>

</body>

</html>