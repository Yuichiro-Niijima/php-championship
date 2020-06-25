<?php session_start() ?> 


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_login.css">
    <link href="https://fonts.googleapis.com/css2?family=Monoton&display=swap" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <div class="main">
        <div class="main_content">
            <h1>G's System</h1>


            <form action="login_act.php" method="POST">
                <fieldset>
                    <p>USER ID</p>
                    <input type="text" name="user_id">
                    <p>PASSWORD</p>
                    <input type="password" name="password">

                    <!-- <img id="captcha" src="/securimage-master/securimage_show.php">

                    <input type="text" name="captcha_code"> -->

                    <img id="captcha" src="./securimage-master/securimage_show.php" alt="CAPTCHA Image" /><br />

                    <!-- コードを入力するフォーム -->
                    <input type="text" name="captcha_code" size="10" maxlength="6" />

                    <a href="#" onclick="document.getElementById('captcha').src = './securimage-master/securimage_show.php?' + Math.random(); return false">
                        <img class="reload" src="リロードアイコン.png" alt="Reload Image" height="32" width="32" onclick="this.blur()" align="bottom" border="0" />
                    </a>

                    <?php
                    // 入力があった場合のみ処理する
                    if (!empty($_POST['captcha_code'])) {
                        // secureimage.phpをインクルードする
                        include_once("./securimage-master/securimage.php");

                        // Securimageのオブジェクトを作成する
                        $securimage     = new Securimage();

                        // Securimageオブジェクトの持つcheckメソッドで入力が正しいかを
                        // チェックする
                        if ($securimage->check($_POST['captcha_code']) == false) {
                            echo "認証失敗！";
                            exit;
                        } else {
                            header('Location: main.php');
                        }
                    }
                    ?>



                    <div class="sendBox">
                        <button id="send">
                            <span class="neon">S<span>S</span></span>
                            <span class="neon">E<span>E</span></span>
                            <span class="neon">N<span>N</span></span>
                            <span class="neon">D<span>D</span></span>
                        </button>

                    </div>
                </fieldset>
            </form>
        </div>
    </div>

</body>

</html>