<?php
  session_start();
  require_once('Mail.php');
  require_once('Mail/mime.php');
  
  function email_schedule($student_name, $student_CRNS) {
	    
		$message = "<p>Dear ".$student_name.",</p>
					<p>The following is the list of courses you selected today at your honors 
					advising appointment:
					<br/>".
					for($i=0; $i<count($studentCRNS); $i++) {
						"<tr>
						  <td>".$schedules2[0][$i]['coursePrefix']."</td>
						  <td>".$schedules2[0][$i]['courseNO']."</td>
						  <td>".$schedules2[0][$i]['isHonors']."</td>
						  <td>".$schedules2[0][$i]['CRN']."</td>
						  <td>".$schedules2[0][$i]['days']."</td>
						  <td>".$schedules2[0][$i]['timeStart']."</td>
						  <td>".$schedules2[0][$i]['timeEnd']."</td>
						  <td>".$schedules2[0][$i]['credits']."</td>
						</tr>".
						
					}
					."</p>";
		$target_email = "cspaldi1@emich.edu";
		$from_email = "honors-advising-app-DEV@emich.edu";
		$subject = "Advised Schedule Details";
		mail_any($target_email,$message,$from_email,$subject);
	}
  
  function mail_any($target_email, $message, $from_email, $subject) {

        $headers = array(
            'From' => $from_email,
            'To' => $target_email,
            'Reply-To' => $from_email,
            // 'Bcc' => $GLOBALS['fromEmail'],
			'Subject' => $subject
        );

        $to = $target_email . ',' . $from_email;
        // $crlf = array('ell' => "\r\n");
        //$crlf = array('eol' => "\r\n");
        $crlf = "\n";

        $mime = new Mail_mime($crlf);
        $mime->setTXTBody();
        $mime->setHTMLBody($message);

        $config = array(
            'host' => 'smtp.emich.edu',
            'port' => 25,
        );

        $smtp = Mail::factory('smtp', $config);

        $mail = $smtp->send($to, $mime->headers($headers), $mime->get());

        if (PEAR::isError($mail)) {
            echo "Email didn't send, also it looks like this:" . $mail->getMessage();
        }
  }
 ?>