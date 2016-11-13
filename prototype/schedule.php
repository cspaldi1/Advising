<html>
<head>
  <link rel="stylesheet" type="text/css" href="./CSS/global.css">
</head>
  <body>
    <div id="container">
      <div id="header"><span id="title">Honors Advising Portal</span>
      </div>
    </div>
    <?php var_dump($_POST);?>
    <div class="page">
      <span><b>Student Schedule</b></span>
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
        <tr>
          <td>COSC</td>
          <td>111</td>
          <td>Yes</td>
          <td>29182</td>
          <td>MW</td>
          <td>9:30-10:45</td>
          <td>3</td>
        </tr>
        <tr>
          <td colspan="6" style="text-align: right; border: none;">Total Credits:</td>
          <td style="text-align: left; border: none;">15</td>
        </tr>
      </table>
    </div>
    <div>
      <div style="margin-top: 10px;">
        <button onclick="window.location.href='complete.html'">Choose Schedule and Submit</button>
      </div>
      <div style="width: 50%; margin: auto; padding-top: 20px;">
        <span style="float: left;"><< Back</span>
        <span style="float: center;">Showing Schedule 3 of 10</span>
        <span style="float: right;"> Forward>></span>
      </div>
    </div>
  </body>
</html>
