<?php
include_once "connection.php";

$selectedChoice = "day"; // Default choice

    $selectedChoice = $_POST['choice']; // Update selected choice if form is submitted
    echo "$selectedChoice";
    if ($selectedChoice=='day'){ 
  
  $querry_pow1="SELECT power, time_ FROM value  where TIMESTAMPDIFF(HOUR, time_, NOW()) < 24";
  $querry_pow2="SELECT power_factor , time_ FROM value  where TIMESTAMPDIFF(HOUR, time_, NOW()) < 24";};

  if ($selectedChoice=='week') {
    
    $querry_pow1="SELECT power, time_ FROM value  where time_ >= DATE_SUB(NOW(), INTERVAL 1 WEEK)";
    $querry_pow2="SELECT power_factor , time_ FROM value  where time_ >= DATE_SUB(NOW(), INTERVAL 1 WEEK)";

  };
  if ($selectedChoice=='month') {
  
  $querry_pow1="SELECT power , time_ FROM value   WHERE time_ >= DATE_SUB(NOW(), INTERVAL 1 MONTH)";
  $querry_pow2="SELECT power_factor , time_ FROM value   WHERE time_ >= DATE_SUB(NOW(), INTERVAL 1 MONTH)";

  };
  if ($selectedChoice=='year') {
   
  $querry_pow1="SELECT power , time_ FROM value  WHERE time_ >= DATE_SUB(NOW(), INTERVAL 1 YEAR)";
  $querry_pow2="SELECT power_factor , time_ FROM value  WHERE time_ >= DATE_SUB(NOW(), INTERVAL 1 YEAR)";
  };

 ?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>
	<title>Controll</title>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body background="background2.png">
	<br>
	<div  style="position: absolute; top: 700px; left: 100px;">
	<button  name="but" id="home" class="on1" style="background-color: #00b712;
	background-image: linear-gradient(315deg, #00b712 0%, #5aff15 74%); left:43%">    ON    </button>

	<button name="sup"  id="home" class="off1" style="background-color: #feae96;
	background-image: linear-gradient(315deg, #feae96 0%, #fe0944 74%); left:44%">    OFF    </button>

	<br><br>
	<button name="but" class="on2" id="home" style="background-color: #00b712;
	background-image: linear-gradient(315deg, #00b712 0%, #5aff15 74%); left:43%"> ON </button>

	<button name="sup" class="off2" id="home" style="background-color: #feae96;
	background-image: linear-gradient(315deg, #feae96 0%, #fe0944 74%); left:44%"> OFF </button></div>
	<div style="position: absolute; top: 600px; left: 100px;">
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
        </div></form> 
    	</div>
<div id="courbe_pow1" style="position: absolute; top: 30px; left: 550px;"></div>
<br><br><br>
<div id="courbe_pow2" style="position: absolute; top: 490px; left: 550px;"></div>
<script src="on1.js"></script>

</html>



<script type="text/javascript">
      google.charts.load('current', {'packages':['line']});
      google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('date', 'Day');
      data.addColumn('number', 'current');
      data.addRows([ 
    
          <?php
          $req = mysqli_query($con ,$querry_pow1);
           while ($data=mysqli_fetch_array($req)) {
              $pow1=$data['power'];
               
              $time=$data['time_'];
              $month="$time[5]$time[6]"-1;
        ?>


        [<?php echo "new Date($time[0]$time[1]$time[2]$time[3],$month,$time[8]$time[9],$time[11]$time[12],$time[14]$time[15])"; ?>,<?php echo "$pow1"; ?>],
        <?php
         }
        ?>
      ]);

      var options = {
        chart: {
          title: 'Current',
          subtitle: 'Amper'
        },
        width: 1350,
        height: 450,
        axes: {
          x: {
            0: {side: 'top'}
          }
        }
      };

      var chart = new google.charts.Line(document.getElementById('courbe_pow1'));

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
          $req = mysqli_query($con ,$querry_pow2);
           while ($data=mysqli_fetch_array($req)) {
              $pow2=$data['power_factor'];
               
              $time=$data['time_'];
              $month="$time[5]$time[6]"-1;
        ?>


        [<?php echo "new Date($time[0]$time[1]$time[2]$time[3],$month,$time[8]$time[9],$time[11]$time[12],$time[14]$time[15])"; ?>,<?php echo "$pow2"; ?>],
        <?php
         }
        ?>
      ]);

      var options = {
        chart: {
          title: 'Channel 2',
          subtitle: 'KW'
        },
        width: 1350,
        height: 450,
        axes: {
          x: {
            0: {side: 'top'}
          }
        }
      };

      var chart = new google.charts.Line(document.getElementById('courbe_pow2'));

      chart.draw(data, google.charts.Line.convertOptions(options));
    }


  </script>

  <style type="text/css">
  	#home {
  

  padding: 1.3em 3em;
  font-size: 12px;
  text-transform: uppercase;
  letter-spacing: 2.5px;
  font-weight: 1000;
  color: #000;
  background-color: #fff;
  border: none;
  border-radius: 45px;
  box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease 0s;
  cursor: pointer;
  outline: none;
}

#home:hover {
  background-color: #7E95FB;
  box-shadow: 0px 15px 20px rgba(46, 229, 157, 0.4);
  color: #fff;
  transform: translateY(-7px);

}

#home:active {
  transform: translateY(-1px);
}
#block{

  position: absolute;
  top: 50%;
  width: 95%;
  text-align: center;
  font-size: 15px;
}
  </style>