<?php
include_once "connection.php";


  $querry_volt="SELECT voltage , time_ FROM value  WHERE time_ >= DATE_SUB(NOW(), INTERVAL 1 YEAR)";
  $querry_curr="SELECT current , time_ FROM value  WHERE time_ >= DATE_SUB(NOW(), INTERVAL 1 YEAR)";
  $querry_pow="SELECT power , time_ FROM value  WHERE time_ >= DATE_SUB(NOW(), INTERVAL 1 YEAR)";
  $querry_pow_fac="SELECT power_factor , time_ FROM value1  WHERE time_ >= DATE_SUB(NOW(), INTERVAL 1 YEAR)";
  
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temperature Box</title>
    <link rel="stylesheet" href="styles.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
</head>
<body background="background3.png">
    <div class="temperature-box" style="position: absolute; top: 10px; left: 300px;">
        <span class="temperature">25°C</span>
        
    </div>
    <div class="temperature-box" style="position: absolute; top: 490px; left: 300px;">
        <span class="temperature">25°C</span>
    </div>
    <div class="temperature-box" style="position: absolute; top: 10px; left: 1300px;">
        <span class="temperature">25°C</span>
    </div>
    <div class="temperature-box" style="position: absolute; top: 490px; left: 1300px;">
        <span class="temperature">25°C</span>
    </div>

<div id="courbe_volt" style="position: absolute; top: 70px; left: 20px;"></div>
    <br>
    <div id="courbe_curr" style="position: absolute; top: 550px; left: 20px;"></div>
    <br>
    <div id="courbe_power_factor" style="position: absolute; top: 70px; left: 1000px;"></div>
    <br>
    <div id="courbe_power" style="position: absolute; top: 550px; left: 1000px;"></div>


   
  



</body>
</html>
<style type="text/css">
	.temperature-box {
    width: 100px;
    height: 50px;
    background-color: #f0f0f0;
    border: 2px solid #3498db;
    border-radius: 10px;
    display: flex;
    justify-content: center;
    align-items: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.temperature {
    font-size: 36px;
    font-weight: bold;
    color: #333;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
}

</style>
<script type="text/javascript">
      google.charts.load('current', {'packages':['line']});
      google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('date', 'Day');
      data.addColumn('number', 'Voltage');
      data.addRows([ 
    
          <?php
          $req = mysqli_query($con , $querry_volt);
           while ($data=mysqli_fetch_array($req)) {
              $volt=$data['voltage'];
               
              $time=$data['time_'];
              $month="$time[5]$time[6]"-1;
        ?>


        [<?php echo "new Date($time[0]$time[1]$time[2]$time[3],$month,$time[8]$time[9],$time[11]$time[12],$time[14]$time[15])"; ?>,<?php echo "$volt"; ?>],
        <?php
         }
        ?>
      ]);

      var options = {
        chart: {
          title: 'Voltage',
          subtitle: 'Volt'
        },
        width: 800,
        height: 400,
        axes: {
          x: {
            0: {side: 'top'}
          }
        }
      };

      var chart = new google.charts.Line(document.getElementById('courbe_volt'));

      chart.draw(data, google.charts.Line.convertOptions(options));
    }
  </script>
  <script type="text/javascript">
      google.charts.load('current', {'packages':['line']});
      google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('date', 'Day');
      data.addColumn('number', 'current');
      data.addRows([ 
    
          <?php
          $req = mysqli_query($con ,$querry_curr);
           while ($data=mysqli_fetch_array($req)) {
              $curr=$data['current'];
               
              $time=$data['time_'];
              $month="$time[5]$time[6]"-1;
        ?>


        [<?php echo "new Date($time[0]$time[1]$time[2]$time[3],$month,$time[8]$time[9],$time[11]$time[12],$time[14]$time[15])"; ?>,<?php echo "$curr"; ?>],
        <?php
         }
        ?>
      ]);

      var options = {
        chart: {
          title: 'Current',
          subtitle: 'Amper'
        },
        width: 800,
        height: 400,
        axes: {
          x: {
            0: {side: 'top'}
          }
        }
      };

      var chart = new google.charts.Line(document.getElementById('courbe_curr'));

      chart.draw(data, google.charts.Line.convertOptions(options));
    }
  </script>
  <script type="text/javascript">
      google.charts.load('power_factor', {'packages':['line']});
      google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('date', 'Day');
      data.addColumn('number', 'current');
      data.addRows([ 
    
          <?php
          $req = mysqli_query($con ,$querry_pow_fac);
           while ($data=mysqli_fetch_array($req)) {
              $pow_fac=$data['power_factor'];
               
              $time=$data['time_'];
              $month="$time[5]$time[6]"-1;
        ?>


        [<?php echo "new Date($time[0]$time[1]$time[2]$time[3],$month,$time[8]$time[9],$time[11]$time[12],$time[14]$time[15])"; ?>,<?php echo "$pow_fac"; ?>],
        <?php
         }
        ?>
      ]);

      var options = {
        chart: {
          title: 'Power Factor',
          subtitle: 'unit'
        },
        width: 800,
        height: 400,
        axes: {
          x: {
            0: {side: 'top'}
          }
        }
      };

      var chart = new google.charts.Line(document.getElementById('courbe_power_factor'));

      chart.draw(data, google.charts.Line.convertOptions(options));
    }
  </script>

   <script type="text/javascript">
      google.charts.load('power', {'packages':['line']});
      google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('date', 'Day');
      data.addColumn('number', 'power');
      data.addRows([ 
    
          <?php
          $req = mysqli_query($con ,$querry_pow);
           while ($data=mysqli_fetch_array($req)) {
              $pow=$data['power'];
               
              $time=$data['time_'];
              $month="$time[5]$time[6]"-1;
        ?>


        [<?php echo "new Date($time[0]$time[1]$time[2]$time[3],$month,$time[8]$time[9],$time[11]$time[12],$time[14]$time[15])"; ?>,<?php echo "$pow"; ?>],
        <?php
         }
        ?>
      ]);

      var options = {
        chart: {
          title: 'Power',
          subtitle: 'Whatt'
        },
        width:800,
        height: 400,
        axes: {
          x: {
            0: {side: 'top'}
          }
        }
      };

      var chart = new google.charts.Line(document.getElementById('courbe_power'));

      chart.draw(data, google.charts.Line.convertOptions(options));
    }
  </script>
<style type="text/css">
  