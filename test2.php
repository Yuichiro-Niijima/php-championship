<!DOCTYPE html>
<html>

<head>

   
    <title>Books Search Software</title>

<body >

    <form id="myform">
        <div>
            <input type="search" id="books">
        </div>
        <button >Search Books</button>
    </form>


    <div id="result">
    </div>
    <div>
        <p class="addBook"></p>
    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- <script src="myscript.js"></script> -->

    <script>
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
                            title = $('<li value="' + i + '">' + response.items[i].volumeInfo.title + '</li>');
                            // author = $('<h5 class="center-align white-text"> By:' + response.items[i].volumeInfo.authors + '</h5>');
                            // img = $('<img ><br><a href=' + response.items[i].volumeInfo.infoLink + '><button>追加</button></a>');
                            // url = response.items[i].volumeInfo.imageLinks.thumbnail;
                            // img.attr('src', url);
                            title.appendTo('#result');
                            // author.appendTo('#result');
                            // img.appendTo('#result');

                        }
                        $(document).on("click", "li", function() {
                            let val = $(this).val();
                            alert(val);

                            img = $('<img ><br><a href=' + response.items[val].volumeInfo.infoLink + '><button>追加</button></a>');
                            url = response.items[val].volumeInfo.imageLinks.thumbnail;
                            img.attr('src', url);

                            img.appendTo('.addBook');


                            // alert(response.items[0].volumeInfo.title);
                            // img.appendTo('p');
                            // img.appendTo('.addBook');
                            // $(this)

                        });


                    });


                }
                return false;
            });


        });

        // $(document).on("click", "h5", function() {
        //     alert("ok");
        //     // img.appendTo('p');
        //     img.appendTo('#result');
        // });
    </script>
</body>
</head>

</html>