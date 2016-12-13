<?php

session_start();
if(isset($_SESSION['field1']) && isset($_SESSION['field2']) && isset($_SESSION['arrX']) && isset($_SESSION['arrY'])) {
  $namaField1 = $_SESSION['field1'];
  $namaField2 = $_SESSION['field2'];
  $x = $_SESSION['arrX'];
  $y = $_SESSION['arrY'];
}

  //Sum x and y
  $sumX = doSum($x);
  $sumY = doSum($y);

  //Mean x and mean y
  $meanX = $sumX / count($x);
  $meanY = $sumY / count($y);

  //ori - mean
  $minX = doMinMean($x,$meanX);
  $minY = doMinMean($y,$meanY);

  //pow min
  $powX = doPower($minX);
  $sumPowX = doSum($powX);

  //minX by minY
  $by = doBy($minX,$minY);
  $sumBy = doSum($by);

  //b1
  $b1 = $sumBy / $sumPowX;
  $b0 = $meanY - $b1 * $meanX;

  //function
  $function = "Y = ".number_format((float)$b0, 4, '.', '')." + ".number_format((float)$b1, 4, '.', '')." ( X )";
  echo "<script type='text/javascript'> var b0 = ".number_format((float)$b0, 4, '.', '')."; var b1 = ".number_format((float)$b1, 4, '.', '')." </script>";

  function doMinMean($ori,$mean) {
    $array = array();
    for ($i=0; $i < count($ori); $i++) {
      $count = $ori[$i] - $mean;
      array_push($array,$count);
    }
    return $array;
  }

  function doPower($min) {
    $array = array();
    for ($i=0; $i < count($min); $i++) {
      array_push($array,pow($min[$i],2));
    }
    return $array;
  }

  function doBy($minX,$minY) {
    $array = array();
    for ($i=0; $i < count($minX); $i++) {
      array_push($array,$minX[$i]*$minY[$i]);
    }
    return $array;
  }

  function doSum($arr) {
    $sum = 0;
    for ($i=0; $i < count($arr); $i++) {
      $sum += $arr[$i];
    }
    return $sum;
  }

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Regresi Linear</title>

    <link rel="stylesheet" type="text/css" href="library/bootstrap/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="library/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/custom.css">

    <script type="text/javascript" src="script.js"></script>
  </head>
  <body id="bodyhitung">
    <div class="container" id="container-hitung">
      <div class="wrapper>">
        <br/><br/>
        <ul class="breadcrumb" id="submenu">
          <li><a style="font-family: 'Montserrat';" href="index.php">Home</a></li>
          <li><a style="font-family: 'Montserrat';" href="hitung.php">Hitung</a></li>
          <li><a style="font-family: 'Montserrat';" href="regresi.php">Contoh</a></li>
        </ul>
          <a href="hitung.php"><button class="btn btn-primary" type="button" name="button" id="back">Back</button></a>
          <a href="index.php"><button class="btn btn-success" type="button" name="button" id="back">Home</button></a>
          <br><br>
          <table class="table table-striped table-hover table-responsive" id="tablenya">
            <thead>
              <tr>
                <th><?=$namaField1;?> (X)</th>
                <th><?=$namaField2;?> (Y)</th>
                <th>X - <span class="topline">X</span></th>
                <th>Y - <span class="topline">Y</span></th>
                <th>(X - <span class="topline">X</span>)<sup>2</sup></th>
                <th>(X - <span class="topline">X</span>)(Y - <span class="topline">Y</span>)</th>
              </tr>
            </thead>
            <tbody>
              <?php
              for ($i = 0; $i < count($x); $i++) {
                echo "<tr>";
                echo "<td>".$x[$i]."</td>";
                echo "<td>".$y[$i]."</td>";
                echo "<td>".$minX[$i]."</td>";
                echo "<td>".$minY[$i]."</td>";
                echo "<td>".$powX[$i]."</td>";
                echo "<td>".$by[$i]."</td>";
                echo "</tr>";
              }
              echo "<tr><td>Mean = ".$meanX."</td><td>Mean = ".$meanY."</td><td></td><td></td><td> Total = ".$sumPowX."</td><td> Total = ".$sumBy."</td></tr>";
              ?>
            </tbody>
          </table>
          <div class="rumus" >
            <p class="bg-info"><?=$function;?></p>
          </div>
          <div class="calculator">
            <h2>Mari berhitung !</h2><br/>


              <p> Jika kita punya <b><?=$namaField1;?></b>
                <input type="text" id="nilai">

              , maka <b><?=$namaField2;?>nya</b> adalah <span id="hasil"></span>
            </p>
          </div>

        </div>
      </div>

<br/><br/>


    <script type="text/javascript">
      var el = document.getElementById('nilai');
      nilai.addEventListener("keyup", function(){
        var nilai = el.value;
        var hasil = document.getElementById('hasil');
        hasil.innerHTML = b0 + b1 * nilai;
      });
    </script>
  </body>
</html>
