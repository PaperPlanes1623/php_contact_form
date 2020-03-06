<?php
  //message vars
  $msg = '';
  $msgClass = '';
  //check for submit
  if(filter_has_var(INPUT_POST, 'submit')){
    //get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

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
        echo 'PASSED';
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
        <a class="navbar-brand" href="index.php">My Website</a>
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
      <input type="text" name="name" class="form-control" value="">
    </div>
    <div class="form-group">
      <label>Email</label>
      <input type="text" name="email" class="form-control" value="">
    </div>
    <div class="form-group">
      <label>Message</label>
      <textarea name="message" class="form-control"></textarea>
    </div>
    <br>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</body>
</html>