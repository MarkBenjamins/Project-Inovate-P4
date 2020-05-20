<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="Css\style.css" type="text/css">
    <title></title>
</head>

<body>
    <?php
    $DBConnect = mysqli_connect("127.0.0.1", "root", "");
    if ($DBConnect == false)
    {
        echo "unable to connect to the database server";
    }
    else 
    {
        $DBName = "naam";
        $Tablename = "naam";
        mysqli_select_db($DBConnect, $DBName);

        $SQL = "SELECT";

        if ($stmt = mysqli_prepare($DBConnect, $SQL))
        {
            $SQLResult = mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $name, $picture, $available);
            mysqli_stmt_store_result($stmt);

            if ($SQLResult !== false)
            {
                $numberOfRows = mysqli_stmt_num_rows($stmt);
                while (mysqli_stmt_fetch($stmt))
                {
                    echo "resultatenin een tabel";
                }
            }
            else
            {
                echo "Query failed";
            }
        }
    }
    ?>
</body>
</html>