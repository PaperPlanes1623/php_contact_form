<?php
  //message vars
  $msg = '';
  $msgClass = '';
  //check for submit
  if(filter_has_var(INPUT_POST, 'submit')){
    //get form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    //check required fields
    if(!empty($email) && !empty($name) && !empty($message)){
      //passed
      //check email validation
      if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
        //failed
        $msg = 'Please use a valid email';
        $msgClass = 'alert-danger';
      } else {
        //passed
        //recipient email
        $toEmail = 'dylantaft16@gmail.com';
        //subject
        $subject = 'Contact Request From ' . $name;
        $body = '<h2>Contact Request</h2>
          <h4>Name</h4><p>'.$name.'</p>
          <h4>Email</h4><p>'.$email.'</p>
          <h4>Message</h4><p>'.$message.'</p>';

          //email headers
          $headers = "MIME-Version: 1.0" . "\r\n";
          $headers .="Content-Type:text/html;charset-UTF-8" . "
          \r\n";
          //Additional Headers
          $headers .= "From: " .$name. "<".$email.">"."\r\n";

          if(mail($toEmail, $subject, $body, $headers)){
            //email sent
            $msg = 'Your email has been sent';
            $msgClass = 'alert-success';
          } else {
            //failed
            $msg = 'your email was not sent';
            $msgClass = 'alrt-danger';
          }
      }
    } else {
      //failed
      $msg = 'Please fill in all fields';
      $msgClass = 'alert-danger';
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Contact Us</title>
  <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/darkly/bootstrap.min.css" rel="stylesheet" integrity="sha384-rCA2D+D9QXuP2TomtQwd+uP50EHjpafN+wruul0sXZzX/Da7Txn4tB9aLMZV4DZm" crossorigin="anonymous">
</head>
<body>
  <nav class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar-brand" href="index.php">Contact Us</a>
      </div>
    </div>
  </nav>
  <div class="container">
  <?php if($msg): ?>
    <div class="alert <?php echo $msgClass; ?>"><?php echo $msg; ?></div>
  <?php endif; ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <div class="form-group">
      <label>Name</label>
      <input type="text" name="name" class="form-control" 
      value="<?php echo isset($_POST['name']) ? $name : ''; ?>">
    </div>
    <div class="form-group">
      <label>Email</label>
      <input type="text" name="email" class="form-control" 
      value="<?php echo isset($_POST['email']) ? $email : ''; ?>">
    </div>
    <div class="form-group">
      <label>Message</label>
      <textarea name="message" class="form-control">
      <?php echo isset($_POST['message']) ? $message : ''; ?></textarea>
    </div>
    <br>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</body>
</html>