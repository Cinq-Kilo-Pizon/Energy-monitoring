<?php
include_once "../connection.php";

$selectedChoice = "day"; // Default choice

    $selectedChoice = $_POST['choice']; // Update selected choice if form is submitted
    
    if ($selectedChoice=='day'){ 
  $querry_volt="SELECT voltage , time_ FROM value  where TIMESTAMPDIFF(HOUR, time_, NOW()) < 24";
  $querry_curr="SELECT current , time_ FROM value  where TIMESTAMPDIFF(HOUR, time_, NOW()) < 24";
  $querry_pow="SELECT power, time_ FROM value  where TIMESTAMPDIFF(HOUR, time_, NOW()) < 24";
  $querry_pow_fac="SELECT power_factor , time_ FROM value  where TIMESTAMPDIFF(HOUR, time_, NOW()) < 24";};

  if ($selectedChoice=='week') {
     $querry_volt="SELECT voltage , time_ FROM value where time_ >= DATE_SUB(NOW(), INTERVAL 1 WEEK)";
    $querry_curr="SELECT current , time_ FROM value  where time_ >= DATE_SUB(NOW(), INTERVAL 1 WEEK)";
    $querry_pow="SELECT power, time_ FROM value  where time_ >= DATE_SUB(NOW(), INTERVAL 1 WEEK)";
    $querry_pow_fac="SELECT power_factor , time_ FROM value  where time_ >= DATE_SUB(NOW(), INTERVAL 1 WEEK)";

  };
  if ($selectedChoice=='month') {
   $querry_volt="SELECT voltage , time_ FROM value  WHERE time_ >= DATE_SUB(NOW(), INTERVAL 1 MONTH)";
  $querry_curr="SELECT current , time_ FROM value   WHERE time_ >= DATE_SUB(NOW(), INTERVAL 1 MONTH)";
  $querry_pow="SELECT power , time_ FROM value   WHERE time_ >= DATE_SUB(NOW(), INTERVAL 1 MONTH)";
  $querry_pow_fac="SELECT power_factor , time_ FROM value   WHERE time_ >= DATE_SUB(NOW(), INTERVAL 1 MONTH)";

  };
  if ($selectedChoice=='year') {
   $querry_volt="SELECT voltage , time_ FROM value  WHERE time_ >= DATE_SUB(NOW(), INTERVAL 1 YEAR)";
  $querry_curr="SELECT current , time_ FROM value  WHERE time_ >= DATE_SUB(NOW(), INTERVAL 1 YEAR)";
  $querry_pow="SELECT power , time_ FROM value  WHERE time_ >= DATE_SUB(NOW(), INTERVAL 1 YEAR)";
  $querry_pow_fac="SELECT power_factor , time_ FROM value  WHERE time_ >= DATE_SUB(NOW(), INTERVAL 1 YEAR)";
  };

 ?>


  <!DOCTYPE html>
<html>
<head>
<title>Home</title>
 <link rel = "stylesheet" type = "text/css" href = "style.css">   
 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
</head>
<body background="background3.png">


      <br>
      <div style="position: absolute; top: 5px; left: 15px;">
      <form  method="POST">
       <div class="select_continer" style="display: flex;
       height: 50px; width: 100px;"> 
        <select id="choice" name="choice" class="select_box">
            <option value="day">24h</option>
            <option value="week">7j</option>
            <option value="month">un mois</option>
            <option value="year">une année</option>
           
        </select>
        <button type="submit">Submit</button>
        </div>
        
    </form> 
    </div>
   
    
    
    <div id="courbe_power" style="position: absolute; top: 70px; left: 20px;"></div>
    
  
</body>
</html>
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
        width: 700,
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
        width: 1870,
        height: 850,
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
        width: 700,
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
        width: 1870,
        height: 850,
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
  


/* CSS */
.button-48 {
  appearance: none;
  background-color: #FFFFFF;
  border-width: 0;
  box-sizing: border-box;
  color: #000000;
  cursor: pointer;
  display: inline-block;
  font-family: Clarkson,Helvetica,sans-serif;
  font-size: 14px;
  font-weight: 500;
  letter-spacing: 0;
  line-height: 1em;
  margin: 0;
  opacity: 1;
  outline: 0;
  padding: 1.5em 2.2em;
  position: relative;
  text-align: center;
  text-decoration: none;
  text-rendering: geometricprecision;
  text-transform: uppercase;
  transition: opacity 300ms cubic-bezier(.694, 0, 0.335, 1),background-color 100ms cubic-bezier(.694, 0, 0.335, 1),color 100ms cubic-bezier(.694, 0, 0.335, 1);
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  vertical-align: baseline;
  white-space: nowrap;
}

.button-48:before {
  animation: opacityFallbackOut .5s step-end forwards;
  backface-visibility: hidden;
  background-color: #EBEBEB;
  clip-path: polygon(-1% 0, 0 0, -25% 100%, -1% 100%);
  content: "";
  height: 100%;
  left: 0;
  position: absolute;
  top: 0;
  transform: translateZ(0);
  transition: clip-path .5s cubic-bezier(.165, 0.84, 0.44, 1), -webkit-clip-path .5s cubic-bezier(.165, 0.84, 0.44, 1);
  width: 100%;
}

.button-48:hover:before {
  animation: opacityFallbackIn 0s step-start forwards;
  clip-path: polygon(0 0, 101% 0, 101% 101%, 0 101%);
}

.button-48:after {
  background-color: #FFFFFF;
}

.button-48 span {
  z-index: 1;
  position: relative;
}



/* CSS */
.button-52 {
  font-size: 16px;
  font-weight: 200;
  letter-spacing: 1px;
  padding: 13px 20px 13px;
  outline: 0;
  border: 1px solid black;
  cursor: pointer;
  position: relative;
  background-color: rgba(0, 0, 0, 0);
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
}

.button-52:after {
  content: "";
  background-color: #ffe54c;
  width: 100%;
  z-index: -1;
  position: absolute;
  height: 100%;
  top: 7px;
  left: 7px;
  transition: 0.2s;
}

.button-52:hover:after {
  top: 0px;
  left: 0px;
}

@media (min-width: 768px) {
  .button-52 {
    padding: 13px 50px 13px;
  }
}


/* CSS */
.button-54 {
  font-family: "Open Sans", sans-serif;
  font-size: 16px;
  letter-spacing: 2px;
  text-decoration: none;
  text-transform: uppercase;
  color: #000;
  cursor: pointer;
  border: 3px solid;
  padding: 0.25em 0.5em;
  box-shadow: 1px 1px 0px 0px, 2px 2px 0px 0px, 3px 3px 0px 0px, 4px 4px 0px 0px, 5px 5px 0px 0px;
  position: relative;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
}

.button-54:active {
  box-shadow: 0px 0px 0px 0px;
  top: 5px;
  left: 5px;
}

@media (min-width: 768px) {
  .button-54 {
    padding: 0.25em 0.75em;
  }
}
</style>