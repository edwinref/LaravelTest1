@extends('voyager::master')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <title>Document</title>
</head>
<body>

<?php 
  $con = new mysqli('localhost','root','','laravel');
  $query = $con->query("
  SELECT COUNT(id),MONTH(Created_At) from `professeurs` group BY MONTH(Created_At)
  ");

  foreach($query as $data)
  {
    $month[] = $data['MONTH(Created_At)'];
    $amount[] = $data['COUNT(id)'];
    
  }

?>

    
 

<center>
  <br><br><br><br><br><br>
<p>les graphs en fonction de base de donné</p>
<table>
<tbody>
  <tr>
    <td>
<div style="width: 400px; float:left">
  <canvas id="myChart" width="400" height="400"></canvas>
</div>
</td>
<script>
  // === include 'setup' then 'config' above ===
  const labels = <?php echo json_encode($month) ?>;
  const data = {
    labels: labels,
    datasets: [{
      label: 'Nbr de dossier en foction des mois',
      data: <?php echo json_encode($amount) ?>,
      backgroundColor: [
        'rgba(255, 129, 102, 1)',
        'rgba(75, 192, 192, 1)',
               'rgba(234, 162, 235, 1)',
               'rgba(255, 206, 36, 1)',
               'rgba(75, 192, 192, 1)',
               'rgba(153, 102, 255, 1)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(201, 203, 207, 0.2)'
      ],
      borderColor: [
        'rgb(50, 99, 132)',
        'rgb(255, 159, 64)',
        'rgb(255, 205, 86)',
        'rgb(75, 192, 192)',
        'rgb(54, 162, 235)',
        'rgb(153, 102, 255)',
        'rgb(201, 203, 207)'
      ],
      borderWidth: 1
    }]
  };

  const config = {
    type: 'bar',
    data: data,
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    },
  };

  var myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
</script>
</div>
<td>
<div style="float:right; ">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<canvas id="myChart1" width="400" height="400"></canvas>
</td>
<script>
const ctx = document.getElementById('myChart1').getContext('2d');
const myChart1 = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [ '2022', '2023', '2024'],
        datasets: [{
            label: '# of Votes',
            data: [<?php
        $conn = mysqli_connect("localhost", "root", "", "laravel");
         $sql = "SELECT  count(id)  FROM `professeurs`  ";
         $fire = mysqli_query($conn,$sql);
          while ($result = mysqli_fetch_assoc($fire)) {
            echo $result['count(id)'];
          }
?>
        ],
            backgroundColor: [
              'rgba(255, 206, 36, 1)',
               'rgba(75, 192, 192, 1)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)'
                
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
</table>
</center>
</body>
</html>
@endsection