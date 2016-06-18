<?php

?>

<html>
    <head>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

        <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>


        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    </head>

    <body>
        <div class="container-fluid">
            <div class="col-md-10 col-md-offset-1">
                <img src="//s.w.org/style/images/wp-header-logo.png?1" alt=""/>

            </div>

            <div class="result">

            </div>
            <div class="col-md-10 col-md-offset-1">
                <form>
                    <div class="form-group">
                        <label for="WpUrl">Database Password for WP</label>
                        <input type="text" class="form-control" id="WpUrl" placeholder="URL of the wordpress website">
                    </div>

                    <div class="form-group">
                        <label for="rootPassword">MySQL Root Password"</label>
                        <input type="password" class="form-control" id="rootPassword" placeholder="MySQL Root Password">
                    </div>
                    <div class="form-group">
                        <label for="DBName">DataBase Name for WP</label>
                        <input type="text" class="form-control" id="DBName" placeholder="Database name for the wordpress website">
                    </div>
                    <div class="form-group">
                        <label for="DBUserName">Database Username for WP</label>
                        <input type="text" class="form-control" id="DBUserName" placeholder="Database Username for the wordpress website">
                    </div>
                    <div class="form-group">
                        <label for="DBUPassword">Database Password for WP</label>
                        <input type="text" class="form-control" id="DBUPassword" placeholder="Database Password for the wordpress website">
                    </div>


                    <button type="submit" id="validate" class="btn btn-default">Installation</button>
                </form>
            </div>
        </div>

    </body>
</html>

<script>
    $("#validate").click(function(){
        event.preventDefault();
        console.log('toto');
        var url = $('#WpUrl').val();
        var rootpassword = $('#rootPassword').val();
        var dbname = $('#DBName').val();
        var user = $('#DBUserName').val();
        var pass = $('#DBUPassword').val();

        $.ajax({
            url: 'createXMLConfig.php',
            type: 'POST',
            dataType: "html",
            data: {rootpassword : rootpassword, dbname : dbname, username : user, userpassword :pass, wpurl : url},
            success: function(data) {
                $('.result').append(data);

            }
        })

    });

</script>