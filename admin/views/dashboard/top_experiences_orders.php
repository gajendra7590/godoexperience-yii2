<?php
use yii\helpers\Html;
use yii\helpers\Url;
use common\helpers\Utils;
?>

<div id="topExperiencesByOrder" style="height: 300px; width: 100%;margin-bottom: 10px;"></div>

<script>
    var chart = new CanvasJS.Chart("topExperiencesByOrder", {
        animationEnabled: true,
        theme: "light2",
        axisY: {
            title: "Order Counts",
            labelFontSize: 20,
        },
        axisX: {
            title: "Experience ID",
            labelAngle: -30
        },
        data: [{
            type: "column",
            yValueFormatString: "#,##0.## orders",
            dataPoints: <?php echo json_encode($data, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();
</script>
