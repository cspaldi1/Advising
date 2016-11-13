<?php session_start();?>

<html>
<head>
  <link rel="stylesheet" type="text/css" href="./CSS/global.css">
</head>
  <body>
    <div id="container">
      <div id="header"><span id="title">Honors Advising Portal</span>
      </div>
    </div>
    <div class="page">
      <span><b>Student Schedule for <?=$_SESSION['student']['fname']?></b></span>
      <table>
        <tr>
          <th>Prefix</th>
          <th>Course No.</th>
          <th>Honors</th>
          <th>CRN</th>
          <th>Days</th>
          <th>Time</th>
          <th>Credits</th>
        </tr>
        <?php
        for($i=0; $i<count($_POST['prefix']); $i++)
        { ?>
          <tr>
            <td><?=$_POST['prefix'][$i]?></td>
            <td><?=$_POST['courseNo'][$i]?></td>
            <td><?=$_POST['honors'][$i]?></td>
            <td><?=$_POST['crn'][$i]?></td>
            <td><?=$_POST['days'][$i]?></td>
            <td><?=$_POST['time'][$i]?></td>
            <td><?=$_POST['credits'][$i]?></td>
          </tr>
        <?php
          } ?>
        <tr>
          <td colspan="6" style="text-align: right; border: none;">Total Credits:</td>
          <td style="text-align: left; border: none;"></td>
        </tr>
      </table>
    </div>
    <div>
      <div style="margin-top: 10px;">
        <button onclick="window.location.href='complete.html'">Choose Schedule and Submit</button>
      </div>
      <div style="width: 50%; margin: auto; padding-top: 20px;">
        <span style="float: left;"><< Back</span>
        <span style="float: center;">Showing Schedule 1 of 1</span>
        <span style="float: right;"> Forward>></span>
      </div>
    </div>
  </body>
</html>
