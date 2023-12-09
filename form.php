<?php
function validate_message($message)
{
   
    $trimmedMessage = trim($message);

    
    if (strlen($trimmedMessage) >= 10) {
        return true;
    }

    return false; 
}

function validate_username($username)
{
  
    $trimmedUsername = trim($username);

    
    if (ctype_alnum($trimmedUsername)) {
        return true; 
    }

    return false;
}

function validate_email($email)
{

    $trimmedEmail = trim($email);

    
    if (strpos($trimmedEmail, "@") !== false) {
        return true;
    }

    return false; 
}

$user_error = "";
$email_error = "";
$terms_error = "";
$message_error = "";


$terms = "";
$username = "";
$email = "";
$message = "";


$form_valid = true;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = '';
if (isset($_POST['email'])) {
    $email = $_POST['email'];
}

$message = '';
if (isset($_POST['message'])) {
    $message = $_POST['message'];
}

$username = '';
if (isset($_POST['username'])) {
    $username = $_POST['username'];
}

$terms = '';
if (isset($_POST['terms'])) {
    $terms = $_POST['terms'];
}

    if(!validate_message($message)){

        $message_error = "message must be at least 10 caracters long";
        $form_valid = false;

    }
    if(!validate_username($username)){

        $user_error = "Username should contains only letters and numbers";
        $form_valid = false;

    }
    if(!validate_email($email)){

        $email_error = "Invalid email";
        $form_valid = false;

    }
    
    if($terms != "terms"){

        $terms_error = "you must accept the Terms of Service";
        $form_valid = false;

    }

    // Here is the list of error messages that can be displayed:
    //
    // "Message must be at least 10 caracters long"
    // "You must accept the Terms of Service"
    // "Please enter a username"
    // "Username should contains only letters and numbers"
    // "Please enter an email"
    // "email must contain '@'"

}

?>

<!-- ... (your existing PHP code) ... -->

<form action="index.php" method="POST">
    <div class="row mb-3 mt-3">
        <div class="col">
            <input type="text" class="form-control" placeholder="Enter Name" name="username" value="<?php echo htmlspecialchars($username); ?>">
            <small class="form-text text-danger"> <?php echo $user_error; ?></small>
        </div>
   
        <div class="col">
            <input type="text" class="form-control" placeholder="Enter email" name="email" value="<?php echo htmlspecialchars($email); ?>">
            <small class="form-text text-danger"> <?php echo $email_error; ?></small>
        </div>
    </div>
    <div class="mb-3">
        <textarea name="message" placeholder="Enter message" class="form-control"><?php echo htmlspecialchars($message); ?></textarea>
        <small class="form-text text-danger"> <?php echo $message_error; ?></small>
    </div>
    <div class="mb-3">
        <input type="checkbox" class="form-control-check" name="terms" id="terms" value="terms" <?php echo ($terms == "terms") ? 'checked' : ''; ?>> <label for="terms">I accept the Terms of Service</label>
        <small class="form-text text-danger"> <?php echo $terms_error; ?></small>
    </div>
    <div class="d-grid">
        <button type="submit" class="btn btn-primary" >Submit</button>
    </div>
</form>



<hr>

<?php
if ($form_valid) :
?>
    <div class="card">
        <div class="card-header">
            <p><?php echo $username; ?></p>
            <p><?php echo $email; ?></p>
        </div>
        <div class="card-body">
            <p class="card-text"><?php echo $message; ?></p>
        </div>
    </div>
<?php
endif;
?>