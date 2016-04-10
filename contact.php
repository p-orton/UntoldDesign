<?php include 'header.php'; ?>

<?php
$action=$_REQUEST['action'];
  if ($action=="")    /* display the contact form */
      {
?>
  <div class="row">
    <div class="span3">
      <h3>pull up a chair, let's chat</h3>
      <hr class="hrQuarter">
      <p>about work, about life</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-10 Offset2">
      <form role="form" id="contact-form" method="POST" action="" enctype="multipart/form-data">
        <input type="hidden" name="action" value="submit">
        <div class="form-group control-group">
          <input type="text" class="form-control" id="inputName" placeholder="name" name="name" required>
        </div>
        <div class="form-group control-group">
          <input type="email" class="form-control" id="inputEmail" placeholder="email" name="email" required>
        </div>
        <div class="form-group control-group">
          <input type="text" class="form-control" id="inputSubject" placeholder="subject" name = "subject" required>
        </div>
        <div class="form-group control-group">
          <textarea class="form-control" id="inputMessage" rows="5" placeholder="what's your story?" name="message" required></textarea>
        </div>
        <input type="submit" class="btn btn-default" value="send it"></input>
      </form>
    </div>
  </div>
<?php
      }else                /* send the submitted data */
      {
        $in_name=$_REQUEST['name'];
        $in_email=$_REQUEST['email'];
        $in_message=$_REQUEST['message'];
        $in_subject=$_REQUEST['subject'];
        if (($in_name=="")||($in_email=="")||($in_message=="")||($in_subject==""))
            {
            echo "All fields are required, please fill <a href=\"\">the form</a> again.";
            }
        else{
            $from="From: $in_name<$in_email>\r\nReturn-path: $in_email";
            $subject=$in_subject;
            mail("sbutl310@mtroyal.ca", $subject, $in_message, $from);
            echo "Thank you for reaching out, we'll get back to you shortly!";
            }
      }
?>
<?php include 'footer.php'; ?>
