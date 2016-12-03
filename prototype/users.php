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
 ?>

<html>
<head>
  <link rel="stylesheet" type="text/css" href="./CSS/global.css">
  <script src="./JS/jquery-3.1.1.min.js"></script>

  <script>
    function validateEmail()  {
      var email = document.getElementById('emich').value;

      if (/\w{1,8}@emich\.edu/.test(email)) {
        email = /\w{1,8}/.exec(email);
      }

      if (/\w{1,8}.test(email)) {
        return true;
      }
      alert("Please enter a valid netID/Email.");
      return false;
    }

  </script>

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
          <td><input id="fname" type="text"/></td>
        </tr>
        <tr>
          <td><span>Last Name:</span></td>
          <td><input id="lname" type="text"/></td>
        </tr>
        <tr>
          <td><span>Emich Email:</span></td>
          <td><input id="emich" type="text"/></td>
        </tr>
        <tr>
          <td><span>Temporary Password:</span></td>
          <td><input id="password" type="password"/></td>
        </tr>
        <tr>
          <td><span>Confirm Password:</span></td>
          <td><input id="password2" type="password"/></td>
        </tr>
      </table>
      <div style="text-align: center; padding-top: 5px;">
        <button onclick="addAdvisor();">Add</button>
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
          <td><?=$person['firstName']?></td>
          <td><?=$person['lastName']?></td>
          <td><?=$person['advisorNetID']?>@emich.edu</td>
          <td><?php if ($person['isAdmin'] == 1) echo "Yes"; else echo "No";?></td>
          <td class="tableButton"><button onclick="toggleAdmin(<?=$person['isAdmin']?>, '<?=$person['advisorNetID']?>');"><?php if ($person['isAdmin'] == 1) echo "Demote from Admin"; else echo "Promote to Admin";?></button></td>
          <td class="tableButton"><button>Remove Access</button></td>
        </tr>
        <?php } ?>
      </table>
    </div>
    <div style="text-align: center; padding-top: 10px;">
      <button onclick="window.location.href='home.php'">Home</button>
    </div>
  </body>
  <script>
    function toggleAdmin(adminStatus, netID)
    {
      if(adminStatus == 1)
      {
        var admin = 0;
      } else {
        var admin = 1;
      }
      $.ajax({ url: 'admin_functions.php',
         data: {action: 'status', admin: admin, netID: netID},
         type: 'post',
         success: function(output) {
                      window.location.reload();
                  }
      });
    }

    function addAdvisor()
    {
      var firstName = $("#fname").val().trim();
      var lastName = $("#lname").val().trim();
      var netID = $("#emich").val().trim();
      var password = $("#password").val().trim();
      var password2 = $("#password2").val().trim();

      if(password == password2)
      {
        $.ajax({ url: 'admin_functions.php',
           data: {action: 'addAdvisor', fname: firstName, lname: lastName, netID: netID, password: password},
           type: 'post',
           success: function(output) {
                        window.location.reload();
                    }
        });
      } else {
        alert("The passwords did not match.");
      }
    }
  </script>
</html>
