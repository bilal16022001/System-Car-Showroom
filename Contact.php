<!-- <?php
 
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
          $firstName = $_POST['firstName'];
          $lastName = $_POST['lastName'];
          $email = $_POST['email'];
          $message = $_POST['message'];

          $headers = 'From: ' . $email . '\r\n';

          mail('be77953@gmail.com','Used Car Showroom',$message,$headers);
    }
 

?> -->

<div id="Contact" class="Contact mt-3">
    <div class="container">
      <h1 class="text-center">Contact Us</h1>

        <form method="POST">
            <input type="text" name="firstName" placeholder="first Name" required /><br/>
            <input type="text" name="lastName" placeholder="Last Name" required /><br/>
            <input type="text" name="email" placeholder="email" required/><br/>
            <textarea name="message" required></textarea><br/>
            <input class="btn btn-primary" name="submit" type="submit" value="Send" />
        </form>
    </div>
</div>