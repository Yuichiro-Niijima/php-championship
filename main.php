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



    // while ($row = $stmh->fetch(PDO::FETCH_ASSOC)) {
    // }
}
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Kumar+One+Outline&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sriracha&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Yellowtail&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style_body.css">
    <title>Document</title>
</head>

<body>
    <header>
        <nav>
            <ul class="info">
                <li id="now" class="nav">Now</li>
                <li id="book" class="nav">Book</li>
                <li id="info" class="nav">Info</li>
                <li class="nav">Skill</li>
            </ul>
        </nav>
    </header>


    <main>




        <!------------------------------------->
        <!----------------NOW ----------------->
        <!------------------------------------->
        <div class="now">
            <?php
            $sql2 = 'SELECT * FROM info_table';

            // SQL準備&実行
            $stmt = $pdo->prepare($sql2);
            $status = $stmt->execute();

            // データ登録処理後
            if ($status == false) {
                // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
                $error = $stmt->errorInfo();
                echo json_encode(["error_msg" => "{$error[2]}"]);
                exit();
            } else {
                // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
                // fetchAll()関数でSQLで取得したレコードを配列で取得できる
                $result2 = $stmt->fetchAll(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定
                $output = "";
                // $output2 = "";
                // $output3 = "";
                // <tr><td>deadline</td><td>todo</td><tr>の形になるようにforeachで順番に$outputへデータを追加
                // `.=`は後ろに文字列を追加する，の意味
                foreach ($result2 as $record) {

                    $output .= "<dl>";
                    $output .= "<dt class='id'>{$record["id"]}</dt>";
                    $output .= "<dd class='name'>{$record["student_name"]}</dd>";
                    // $output .= "<dd class='switch3'>";
                    // $output .= "<label class='switch3__label'>";
                    // $output .= "<label class='switch3__label'>";
                    // $output .= "<input type='checkbox' class='switch3__input'/>";
                    // $output .= "<span class='switch3__content'></span>";
                    // $output .= "<span class='switch3__circle'></span>";
                    // $output .= "</label>";
                    // $output .= "</dd>";
                    $output .= "<dd><button>Home</button></dd>";
                    $output .= "<dd><button>G's</button></dd>";
                    $output .= "<dd><button>Engineer Cafe</button></dd>";
                    $output .= "<dd><button dot.</button></dd>";
                    $output .= "</dl>";
                    // var_dump($output);
                }
                // $valueの参照を解除する．解除しないと，再度foreachした場合に最初からループしない
                // 今回は以降foreachしないので影響なし
                unset($value);
            }
            ?>

            <div class="nowBox">
                <?= $output ?>
            </div>


        </div>


        <!------------------------------------->
        <!----------------出席----------------->
        <!------------------------------------->
        <div class="attendance" id="attendance" style="display: none;">
            <table>
                <tr>
                    <th>日付</th>
                    <th>出勤</th>
                </tr>
                <tr>
                    <td>1日</td>
                    <td><?= $result["a"] ?></td>
                </tr>
                <tr>
                    <td>2日</td>
                    <td><?= $result["a"] ?></td>
                </tr>
                <tr>
                    <td>3日</td>
                    <td><?= $result["a"] ?></td>
                </tr>
                <tr>
                    <td>4日</td>
                    <td><?= $result["a"] ?></td>
                </tr>
                <tr>
                    <td>5日</td>
                    <td><?= $result["a"] ?></td>
                </tr>
                <tr>
                    <td>6日</td>
                    <td><?= $result["a"] ?></td>
                </tr>
                <tr>
                    <td>7日</td>
                    <td><?= $result["a"] ?></td>
                </tr>
                <tr>
                    <td>8日</td>
                    <td><?= $result["a"] ?></td>
                </tr>
                <tr>
                    <td>9日</td>
                    <td><?= $result["a"] ?></td>
                </tr>
                <tr>
                    <td>10日</td>
                    <td><?= $result["a"] ?></td>
                </tr>
            </table>

            <table>
                <tr>
                    <th>日付</th>
                    <th>出勤</th>
                </tr>
                <tr>
                    <td>11日</td>
                    <td><?= $result["a"] ?></td>
                </tr>
                <tr>
                    <td>12日</td>
                    <td><?= $result["a"] ?></td>
                </tr>
                <tr>
                    <td>13日</td>
                    <td><?= $result["a"] ?></td>
                </tr>
                <tr>
                    <td>14日</td>
                    <td><?= $result["a"] ?></td>
                </tr>
                <tr>
                    <td>15日</td>
                    <td><?= $result["a"] ?></td>
                </tr>
                <tr>
                    <td>16日</td>
                    <td><?= $result["a"] ?></td>
                </tr>
                <tr>
                    <td>17日</td>
                    <td><?= $result["a"] ?></td>
                </tr>
                <tr>
                    <td>18日</td>
                    <td><?= $result["a"] ?></td>
                </tr>
                <tr>
                    <td>19日</td>
                    <td><?= $result["a"] ?></td>
                </tr>
                <tr>
                    <td>20日</td>
                    <td><?= $result["a"] ?></td>
                </tr>
            </table>

            <table>
                <tr>
                    <th>日付</th>
                    <th>出勤</th>
                </tr>
                <tr>
                    <td>21日</td>
                    <td><?= $result["a"] ?></td>
                </tr>
                <tr>
                    <td>22日</td>
                    <td><?= $result["b"] ?></td>
                </tr>
                <tr>
                    <td>23日</td>
                    <td><?= $result["c"] ?></td>
                </tr>
                <tr>
                    <td>24日</td>
                    <td><?= $result["d"] ?></td>
                </tr>
                <tr>
                    <td>25日</td>
                    <td><?= $result["a"] ?></td>
                </tr>
                <tr>
                    <td>26日</td>
                    <td><?= $result["a"] ?></td>
                </tr>
                <tr>
                    <td>27日</td>
                    <td><?= $result["a"] ?></td>
                </tr>
                <tr>
                    <td>28日</td>
                    <td><?= $result["a"] ?></td>
                </tr>
                <tr>
                    <td>29日</td>
                    <td><?= $result["a"] ?></td>
                </tr>
                <tr>
                    <td>30日</td>
                    <td><?= $result["a"] ?></td>
                </tr>
            </table>
        </div>

        <!-- ---------------------------------- -->
        <!-- ----------   book         -------- -->
        <!-- ---------------------------------- -->
        <div class="book">
            <form id="myform">
                <input type="search" id="books">
                <button>検索</button>
            </form>

            <!-- 本の候補を表示 -->
            <div id="result">
            </div>
            <!-- 以上、本の候補を表示 -->

            <div>
                <table class="bookshelfBox">
                    <tr class="bookshelf">
                        <td class="addBook"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </div>

        </div>


        <!-- info -->

        <div class="infoBox">
            <div class=headerBox>
                <form action="main.php" method="POST" class="student_search">
                    <input type="text" name="student_name" placeholder="氏名を入力してください。" class="inputBox">
                    <button>検索</button>
                </form>
            </div>

            <div class="prf_box">
                <table class="prf_box_left">
                    <tr>
                        <td>番号：</td>
                        <td><?= $result["id"] ?></td>
                    </tr>
                    <tr>
                        <td>氏名：</td>
                        <td><?= $result["student_name"] ?></td>
                    </tr>
                </table>
                <table class="prf_box_center">
                    <tr>
                        <td>性別：</td>
                        <td><?= $result["sex"] ?></td>
                    </tr>
                    <tr>
                        <td>生年月日：</td>
                        <td><?= $result["birthday"] ?></td>
                    </tr>
                </table>

                <table class="prf_box_right">
                    <tr>
                        <td>所属：</td>
                        <td><?= $result["department"] ?></td>
                    </tr>
                    <tr>
                        <td>入学日：</td>
                        <td><?= $result["start_date"] ?></td>
                    </tr>
                </table>
            </div>

            <div class="kadais">
                <p class="kadai">課題1：<a><?= $result["kadai1"] ?></a></p>
                <p class="kadai">課題2：<a><?= $result["kadai2"] ?></a></p>
            </div>



        </div>

    </main>



    <!-- 以下、jquery -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- <script src="myscript.js"></script> -->




    <script>
        $("dd > button").on("click", function() {

            // $(this).toggleClass(".button_place");
            $(this).toggleClass("button_place");
            // $(".id").toggleClass("id_name");
            // $(".name").toggleClass("id_name");
        });




        // 本を検索
        $(document).ready(function() {
            $("#myform").submit(function() {
                var search = $("#books").val();
                if (search == "") {
                    alert("入力！！");
                } else {
                    var url = "";
                    var img = "";
                    var title = "";
                    var author = "";


                    $.get("https://www.googleapis.com/books/v1/volumes?q=" + search, function(response) {
                        for (i = 0; i < response.items.length; i++) {
                            title = $('<div class="searchBooks"><a><li class="li_title" value="' + i + '">' + response.items[i].volumeInfo.title + '</li></a></div>');
                            // author = $('<h5 class="center-align white-text"> By:' + response.items[i].volumeInfo.authors + '</h5>');
                            // img = $('<img ><br><a href=' + response.items[i].volumeInfo.infoLink + '><button>追加</button></a>');
                            // url = response.items[i].volumeInfo.imageLinks.thumbnail;
                            // img.attr('src', url);
                            title.appendTo('#result');
                            // author.appendTo('#result');
                            // img.appendTo('#result');
                        }
                        $(document).on("click", ".li_title", function() {
                            let val = $(this).val();
                            // alert(val);
                            img = $('<img class="abook"><a href=' + response.items[val].volumeInfo.infoLink + '>');
                            url = response.items[val].volumeInfo.imageLinks.thumbnail;
                            // $("#result").show();
                            // $("#result").css("display", "none");
                            // $('#result').remove();
                            img.attr('src', url);
                            img.appendTo('.addBook');
                        });
                    });
                }
                return false;
            });
            $("#books").on("input")
        });



        // booをクリックするとその他が閉じる
        $("#book").on("click", function() {
            // alert("クリック");
            $(".now").css("display", "none");
            $(".book").show();
            $(".infoBox").css("display", "none");
        });
        $("#now").on("click", function() {
            // alert("クリック");
            $(".now").show();
            $(".book").css("display", "none");
            $(".infoBox").css("display", "none");

        });
        $("#info").on("click", function() {
            // alert("クリック");
            $(".infoBox").show();
            $(".now").css("display", "none");
            $(".book").css("display", "none");
        });
    </script>


</body>

</html>