<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
 
<style>
.wrapper{
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  display: flex;
  overflow: hidden;
 
}
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  list-style: none;
  font-family: ‘Montserrat’, sans-serif;
}
body{

    justify-content: center;
   align-items: center;
  background: linear-gradient(
     105deg,
     #ed87c6 ,
     #9c2f70
 );
}

.registration_form{
  border-radius: 5px;
  width: 1000px;
  background: white;
  padding: 15px;
  
}

.col{
    
    margin-top: 25px;
}
.error{
color: red;
/* font-size: smaller; */

}

#bold{
    color: green;
}
 
</style>



</head>
  <body>
    <!-- PHP code -->

<?php
// DEFINE VARIBALE AND SET TO EMPTY

$firstnameErr = $lastnameErr = $birthdayErr = $genderErr = $emailErr = $numberErr = $subjectErr = $fileErr = $checkboxErr = "";

$firstname = $lastname = $birthday = $check = $gender = $email = $number = $subject = $file = $checkbox = $Mchecked = $Fchecked = $Ochecked = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    // first name
    if(empty($_POST["firstname"])){

        $firstnameErr = "*Please Enter First Name.";
    }
    else{
      $firstname = test_input($_POST["firstname"]);
      if(!preg_match("/^[a-zA-Z-']*$/",$firstname))
      {
            $firstnameErr = "*Only character is allowed.";

      }

    }
// Last Name
    if(empty($_POST["lastname"])){
        $lastnameErr = "*Please Enter Last Name.";
    }else{
        $lastname = test_input($_POST["lastname"]);
        if(!preg_match("/^[a-zA-Z-']*$/",$lastname)){
         
            $lastnameErr = "*Only character is allowed.";
        }
    }

    // birthdate

    if(empty($_POST["birthday"])){

        $birthdayErr = "*Birthdate is Required.";
    }else{
      $birthday = test_input($_POST["birthday"]);

    }

    // gender

    if(empty($_POST["gender"])){

        $genderErr = "*Gender is Required.";
    } else{
      $gender = test_input($_POST["gender"]);
      if ($gender == "male"){
          $Mchecked = "checked";
      }
      else if ($gender == "female"){
          $Fchecked = "checked";
      }
      else if($gender == "other"){
         $Ochecked = "checked";
      }
  }


    // Email Input

    if(empty($_POST["email"])){

        $emailErr = "*Email is Required.";
    }
    else{
            $email = test_input($_POST["email"]);

            if(!filter_var($email , FILTER_VALIDATE_EMAIL)){
           $emailErr = "*Invalid email Address.";

            }

    }

    // Phone Number

    if(empty($_POST["number"])){

        $numberErr = "*Number is Required.";
    }
    else{
            $number = test_input($_POST['number']);
            $phc ='/^[0-9]{10,10}$/';
            
            if(!preg_match($phc,$number)){
              
              $numberErr = "*Invalid Number.";
        
      }

            if(!preg_match("/^[0-9]+$/",$number)){
              
              $numberErr = "*Only number is allowed.";
        
      }
    }

    // subject

    if(empty($_POST["subject"])){

        $subjectErr = "*Subject is Required.";
    }else{
      $subject = test_input($_POST["subject"]);

    }
   
  
    $target_file = $_FILES["fileToUpload"]["name"];
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $target_dir = "upload/";
     $target = $target_dir . basename($_FILES["fileToUpload"]["name"]);


        // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        $fileErr = "*Sorry, your file is too large.";
    
      }
     
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
      $fileErr = "*File is Required & only JPG, JPEG, PNG files are allowed.";
    
    }
    else {
        if((move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target))){
            $fileErr = "<b id='bold'>File Uploaded Successfully</b>";
        }
       
      } 

//   check box

if(empty($_POST["checkbox"])){

    $checkboxErr = "*Checkbox is Required.";
}else{

   $checkbox = test_input($_POST["checkbox"]);
   if($checkbox == "checkbox"){

        $check = "checked";
   }
}


}

function test_input($data){

    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars_decode($data);
    return $data;
}


?>


<!-- form is Start -->

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" >
    <div class="wrapper">

   <div class="registration_form">
    
    <h3>Registration Form</h3>

           <!-- Fist Name -->
    <div class="row g-3">
        <div class="col">
          <input type="text" class="form-control" placeholder="First name" id="firstname" value="<?=$firstname ?>" name="firstname" >
          <span class="text-danger font-weight-bold"><?php echo $firstnameErr; ?></span>
        </div>
        

        <!-- Last Name -->
        <div class="col">
          <input type="text" class="form-control" placeholder="Last name"  id="lastname" value="<?=$lastname ?>" name="lastname" >
          <span class="text-danger font-weight-bold"><?php echo $lastnameErr; ?></span>
        </div>     
      </div>

      <!-- Birthday -->
      <div class="row g-3" >
      <div class="col">
        <input type="date" class="form-control" placeholder="Birthday" id="birthday" aria-label="Birthday" value="<?=$birthday ?>" name="birthday" >
        <span class="text-danger font-weight-bold"><?php echo $birthdayErr; ?></span>
    </div>

        <!-- Gender -->
       
        <div class="col">
          
            <div class="form-check form-check-inline">
              
                <label class="form-check-label" for="gender">Gender:</label>
          
              </div>
              
            <div class="form-check form-check-inline" >
                <input class="form-check-input" class="form-control" type="radio" <?php echo $Mchecked;?> name="gender" value="male" id="male"  >
                <label class="form-check-label" for="male">Male</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input"  class="form-control" type="radio" <?php echo $Fchecked;?> name="gender" value="female" id="female" >
                <label class="form-check-label" for="female">Female</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input"  class="form-control" type="radio" <?php echo $Ochecked;?> name="gender" value="other" id="other" >
                <label class="form-check-label" for="other">Other</label>
             
              </div>
              <label id="gender-error" class="text-danger font-weight-bold" for="gender"><?php echo $genderErr; ?></label>

        
      </div>
    </div>

    <!-- Email -->
    <div class="row g-3">
        <div class="col">
          
          <input type="text" class="form-control" placeholder="Email" aria-label="email" value="<?=$email ?>" name="email" id="email">
          <span class="text-danger font-weight-bold"><?php echo $emailErr; ?></span>
        </div>
  
          <!-- Phone Number -->
          <div class="col">
            <input type="text" class="form-control" id="number" aria-label="number" maxlength="10" placeholder="Phone Number" value="<?=$number ?>" name="number">
            <span class="text-danger font-weight-bold"><?php echo $numberErr; ?></span>
        </div>
  
      </div>


  <!-- Subject  -->
  <div class="row g-3">
    <div class="col">
      <select class="form-select" aria-label="Default select example" name="subject" id="subject" >
          <option value="">Subject</option>
        <option <?=$subject == 'physics' ? 'Selected' : '' ?>  value="physics">Physics</option>
        <option <?=$subject == 'english' ? 'Selected' : '' ?>  value="english">English</option>
        <option <?=$subject == 'science' ? 'Selected' : '' ?>  value="science">Science</option>
      </select>
      <span class="text-danger font-weight-bold"><?php echo $subjectErr; ?></span>
    </div>
</div>

<!-- Input file -->
<div class="col">
    <input type="file" id="fileToUpload"  name ="fileToUpload" class="form-control"/>
    <span class="text-danger font-weight-bold"><?php echo $fileErr; ?></span>
</div>



<!-- checkBook -->

    <div class="col">
    <input type="checkbox" class="form-check-input" id="validationFormCheck1" value = "checkbox" <?php echo $check;?> name="checkbox">
    <label class="form-check-label" for="validationFormCheck1"> Agree to terms and conditions.</label>
   
  </div>
  <span class="text-danger font-weight-bold"><?php echo $checkboxErr;  ?></span>

<!-- button -->
<div class="row g-3">
    <div class="col">
<button type="submit" class="btn btn-primary" id="submit" value="submit" name="submit">Submit</button>
</div>
</div>

</div>
</div>
</form>



<!-- Bootstrap-->

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
 
  </body>
</html>
