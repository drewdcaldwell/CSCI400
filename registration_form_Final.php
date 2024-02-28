<!DOCTYPE html>

<!--
    In-Class Lab 2      CSCI-C400       2/7/2024
    Drew Caldwell           Indiana University-Kokomo

    The purpose of this code is to use Regular Expressions to only accept certain user inputs.
    Currently all og the inputs require that they match the respective regular expression. Still needed is validating
    the mail function. The AMPPS and Ko-Turing Server that we are using does not allow for the mail
    function to work. 

-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Registration Form</title>
    <style>
        label {
            width: 5em;
            float: left;
        }
        .error {
            color: #ff0000;
            font-weight: bold;
            border: 0px none;
        }
    </style>
</head>
<body>
<?php

// Initialize the boolean variables
$displayForm = true;
$inputError = false;

// Initialize the message variables for each input
$name_message = "";
$email_message = "";
$phone_message = "";
$language_message = "";
$os_message = "";

// initialize the input variables
$name = "";
$email = "";
$phone = "";
$language = "Choose";
$opSystem = "";

if (isset($_POST['send'])) {
    // Populate variables from user inputs and perform validation
    $name_message = validateName($_POST['name']);
    $email_message = validateEmail($_POST['email']);
    $phone_message = validatePhone($_POST['phone']);
    $language_message = validateLanguage($_POST['language']);

    // validate the operating systems radio input
    if (!empty($_POST['os'])) {
        $opSystem = $_POST['os'];
    }
    $os_message = validateOS($opSystem);

    // Check for any validation errors
    
    if ($name_message === true && $email_message === true && $phone_message === true && $language_message === true && $os_message === true) {
        // Attempt to send the email
        $to = "awny@iuk.edu";
        $subject = "New Application";
        $message = $_POST["name"] . " has submitted his application as follows ...";
        $headers = "From: Webmaster@MySite.com\r\n";
        $headers .= "Content-Type: text/plain; charset=utf-8\r\n";
        $headers .= "Cc: awny@gmail.com";

        $result = mail($to, $subject, $message, $headers);

        if ($result) {
            echo "<strong>Your application form was successfully sent to</strong> " . $to;
            $displayForm = false;
        } else {
            echo "There was a problem sending your submission via email, " . $name;
            die();
        }
    } else {
        $inputError = true;
    }
}

function validateName($name) {
    if (empty($name)) {
        return "Must enter your name!";
    } elseif (!preg_match("/^[A-Za-z]+\s[A-Za-z]'?[A-Za-z]+$/", $name)) {
        return "Invalid name!";
    }
    return true;
}

function validateEmail($email) {
    if (empty($email)) {
        return "Must Enter your email!";
    } elseif (!preg_match("/^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/", $email)) {
        return "Invalid email!";
    }
    return true;
}

function validatePhone($phone) {
    if (empty($phone)) {
        return "Must Enter your Phone Number!";
    } elseif (!preg_match("/^((\d{3}-)|(\(\d{3}\)\s))(\d{3}-\d{4})$/", $phone)) {
        return "Invalid Phone Number";
    }
    return true;
}

function validateLanguage($language) {
    if ($language == "Choose") {
        return "Must choose a language!";
    }
    return true;
}

function validateOS($opSystem) {
    if (empty($opSystem)) {
        return "Must choose an operating system!";
    }
    return true;
}

if ($displayForm) {
    ?>
    <h1>Registration Form</h1>
    <hr>
    <p>Please fill in all fields and click Register. All fields are required</p>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <h2>User Information</h2>

        <!-- create four text boxes for user input -->
        <div>
            <label>Name:</label>
            <input type="text" name="name" value="<?php echo $name; ?>">
            <input type="text" id="name_error" class="error" size="40" value="<?php echo $name_message; ?>">
        </div>
        <div>
            <label>Email:</label>
            <input type="text" name="email" value="<?php echo $email; ?>">
            <input type="text" id="email_error" class="error" size="40" value="<?php echo $email_message; ?>">
        </div>
        <div>
            <label>Phone:</label>
            <input type="text" name="phone" value="<?php echo $phone; ?>">
            <input type="text" id="phone_error" class="error" size="40" value="<?php echo $phone_message; ?>">
        </div>

        <h2>Programming Languages</h2>
        <p>Which programming language would you like to learn?</p>

        <!-- create drop-down list containing languages -->
        <select name="language">
            <option value="Choose">Choose</option>
            <option value="PHP" <?php echo (isset($_POST['language']) && $_POST['language'] == 'PHP') ? "selected" : ""; ?>>PHP</option>
            <option value="Java" <?php echo (isset($_POST['language']) && $_POST['language'] == 'Java') ? "selected" : ""; ?>>Java</option>
            <option value="Javascript" <?php echo (isset($_POST['language']) && $_POST['language'] == 'Javascript') ? "selected" : ""; ?>>Javascript</option>
            <option value="Visual Basic" <?php echo (isset($_POST['language']) && $_POST['language'] == 'Visual Basic') ? "selected" : ""; ?>>Visual Basic</option>
        </select>
        <input type="text" id="language_error" class="error" size="40" value="<?php echo $language_message; ?>">
        <h2>Operating System</h2>
        <p>Which operating system do you use?
            <input type="text" id="os_error" class="error" size="40" value="<?php echo $os_message; ?>">
        </p>

        <p><input type="radio" name="os" value="Windows" <?php echo (isset($_POST['os']) && $_POST['os'] == 'Windows') ? "checked" : ""; ?>/>Windows
            <input type="radio" name="os" value="Mac OS X" <?php echo (isset($_POST['os']) && $_POST['os'] == 'Mac OS X') ? "checked" : ""; ?>/>Mac OS X
            <input type="radio" name="os" value="Linux" <?php echo (isset($_POST['os']) && $_POST['os'] == 'Linux') ? "checked" : ""; ?>/>Linux
            <input type="radio" name="os" value="Other" <?php echo (isset($_POST['os']) && $_POST['os'] == 'Other') ? "checked" : ""; ?>/>Other
        </p>

        <!-- create a submit button -->
        <p>
            <input type="submit" name="send" value="Register"> &nbsp;&nbsp;
            <input type="reset" name="reset" value="Reset">
        </p>
    </form>
    <?php
}
?>
</body>
</html>
