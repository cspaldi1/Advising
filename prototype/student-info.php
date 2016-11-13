<html>
<head>
  <link rel="stylesheet" type="text/css" href="./CSS/global.css">
  <style>
    td {
      border: none;
    }
  </style>
</head>
  <body>
    <div id="container">
      <div id="header"><span id="title">Honors Advising Portal</span></div>
    </div>
    <div id="login">
      <div style="text-align: center; padding-bottom: 10px;">
        <span><b>Student Advising Information</b></span>
      </div>
      <form action="select-courses.php" method="post">
        <table>
          <tr>
            <td><span>EID:</span></td>
            <td><input type="text" name="eid"/></td>
          </tr>
          <tr>
            <td><span>First Name:</span></td>
            <td><input type="text" name="fname"/></td>
          </tr>
          <tr>
            <td><span>Last Name:</span></td>
            <td><input type="text" name="lname"/></td>
          </tr>
          <tr>
            <td><span>Emich Email:</span></td>
            <td><input type="text" name="emich"/></td>
          </tr>
        </table>
        <div style="text-align: center; padding-top: 5px;">
          <input type="submit" value="Continue"/>
        </div>
      </form>
    </div>
  </body>
</html>
