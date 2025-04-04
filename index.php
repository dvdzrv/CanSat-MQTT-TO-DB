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
        $data = $db->query($sql);

        $db->close();
    }
?>

<script>
    window.onload = function () {

        var chart = new CanvasJS.Chart("chartContainer", {
            title: {
                text: "Temp"
            },
            axisY: {
                title: "°C"
            },
            data: [{
                type: "line",
                dataPoints: <?php echo json_encode($data, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();

    }
</script>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>


</body>
</html>