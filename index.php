<!doctype html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Artemis Dashboard</title>
</head>
<body>

<?php
    class MyDB extends SQLite3 {
        function __construct() {
            $this->open('test.db');
        }
    }

    $db = new MyDB();
    if(!$db) {
        echo $db->lastErrorMsg();
    } else {
        $sql =<<<EOF
            SELECT * FROM data;    
EOF;
        $ret = $db->query($sql);
        while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
            echo "ID = ". $row['id'] . "\n";
            echo "MSG_TYPE = ". $row['message_type'] ."\n";
            echo "ADDRESS = ". $row['message'] ."\n";
            echo "\n";
        }
        echo "Operation done successfully\n";
        $db->close();
    }
?>



</body>
</html>