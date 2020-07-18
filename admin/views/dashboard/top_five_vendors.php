<?php
use yii\helpers\Html;
use yii\helpers\Url;
use common\helpers\Utils;

//echo '<pre>';json_encode($data);die;
?>

<div id="topVendors" style="height: 300px; width: 100%;margin-bottom: 10px;"></div>

<script>
    var chart = new CanvasJS.Chart("topVendors", {
        animationEnabled: true,
        theme: "light2",
        axisY: {
            title: "Order Counts",
            wrap: true,
            labelFontSize: 20,
        },
        axisX: {
            title: "Vendors",
        },
        data: [{
            type: "column",
            yValueFormatString: "#,##0.## orders",
            dataPoints: <?php echo json_encode($data, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();
</script>
