<?php
  include("sensitive.php");

  // Check connection
  if (mysqli_connect_errno()) {
      die("Connection failed: " . mysqli_connect_error());
  }

  $query = "SELECT *
          FROM ADVISOR";

  $result = mysqli_query($conn, $query);

  while($row=mysqli_fetch_assoc($result))
  {
    $advisors[] = $row;
  }

  var_dump($advisors);
 ?>

<html>
<head>
  <link rel="stylesheet" type="text/css" href="./CSS/global.css">
  <script src="./JS/jquery-3.1.1.min.js"></script>
</head>
  <body>
    <div id="container">
      <div id="header"><span id="title">Honors Advising Portal</span></div>
    </div>
    <div class="container">
      <div style="text-align: center; padding-bottom: 10px;">
        <span><b>Add Advisor</b></span>
      </div>
      <table class="add">
        <tr>
          <td><span>First Name:</span></td>
          <td><input type="text"/></td>
        </tr>
        <tr>
          <td><span>Last Name:</span></td>
          <td><input type="text"/></td>
        </tr>
        <tr>
          <td><span>Emich Email:</span></td>
          <td><input type="text"/></td>
        </tr>
        <tr>
          <td><span>Temporary Password:</span></td>
          <td><input type="text"/></td>
        </tr>
      </table>
      <div style="text-align: center; padding-top: 5px;">
        <button onclick="window.location.href='users.html'">Add</button>
      </div>
    </div>
    <br/>
    <div class="container" style="display: inline-block">
      <div style="text-align: center; padding-bottom: 10px;">
        <span><b>Current Advisors</b></span>
      </div>
      <table class="add">
        <tr>
          <th>First</th>
          <th>Last</th>
          <th>Email</th>
          <th>Admin</th>
          <th colspan="2">Actions</th>
        </tr>
        <?php foreach($advisors as $key=>$person)
        { ?>
        <tr>
          <td><?=$person['fname']?></td>
          <td><?=$person['lname']?></td>
          <td><?=$person['advisorNetID']?>@emich.edu</td>
          <td><?php if ($person['isAdmin'] == 1) echo "Yes"; else echo "No";?></td>
          <td class="tableButton"><button>Promote to Admin</button></td>
          <td class="tableButton"><button>Remove Access</button></td>
        </tr>
        <?php } ?>
      </table>
    </div>
    <div style="text-align: center; padding-top: 10px;">
      <button onclick="window.location.href='home.html'">Home</button>
    </div>
  </body>
</html>
