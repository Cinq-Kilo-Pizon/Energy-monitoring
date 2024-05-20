<?php
include_once "../connection.php";

$selectedChoice = "day"; // Default choice

    $selectedChoice = $_POST['choice']; // Update selected choice if form is submitted
   
    if ($selectedChoice=='day'){ 
  $querry_volt="SELECT voltage , time_ FROM value  where TIMESTAMPDIFF(HOUR, time_, NOW()) < 24";}

  if ($selectedChoice=='week') {
     $querry_volt="SELECT voltage , time_ FROM value where time_ >= DATE_SUB(NOW(), INTERVAL 1 WEEK)";

  };
  if ($selectedChoice=='month') {
   $querry_volt="SELECT voltage , time_ FROM value  WHERE time_ >= DATE_SUB(NOW(), INTERVAL 1 MONTH)";

  };
  if ($selectedChoice=='year') {
   $querry_volt="SELECT voltage , time_ FROM value  WHERE time_ >= DATE_SUB(NOW(), INTERVAL 1 YEAR)";
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
    
    
    <div id="courbe_volt" style="position: absolute; top: 70px; left: 20px;"></div>
    <br>
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
        width: 1870,
        height: 850,
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