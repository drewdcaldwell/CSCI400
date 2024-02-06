<!DOCTYPE html>

<!-- 
Question 2 HW1_P2 CSCI-C400 Client-Server Web Programming
Drew Caldwell       1/28/2024           IU-Kokomo

The purpose of this code is to assist the user in calculating the factorial of a number 0-10. We
will ask for user input via a form and after pressing the compute button, the resulting number will
be displayed for the user. 

The code is set up to be able to compute the factorial of any number in the form, but we have an if statement
in place to restrict the inputs to be 0-10.
-->


<html>
<head>
<meta charset = "utf-8" />
<title>Factorial Calculator</title></head>
<body>

<?php
// Display the form
$displayForm = TRUE;

// Initialize the integer input variable
$integer = null;

// Initialize the output variable
$output = 1;


//Upon user pressing the "compute" button execute the following
if (isset($_GET['compute'])) {
    // Check if the input in the box is an integer value, if so, store it in the integer variable
    $integer = isset($_GET["integer"]) ? intval($_GET["integer"]) : null;

    // If the integer values is not between 0 and 10 prompt the user to give us a different input
    if ($integer < 0 || $integer > 10) {
        echo "Please submit an integer 0-10";
        $displayForm = true;
    }
    // If the integer is greater than 0, execute the following code, that is, calculate the
    // product of the integers, starting at $integer, and going down to 1
    elseif ($integer > 0) {
        for ($i = $integer; $i > 0; $i--) {
            $output *= $i;
        }
        $displayForm = false; 
    }
    // If the integer input is 0, then by rule, the factorial is 1. Thus, initialize the output to
    // be 1 in this case
    else {
        $output = 1;
        $displayForm = false;
    }
}


if ($displayForm) {
?>
<form action="Q2FactorialCalculator.php" method="get">
      <table border="0">
      <tr>
        <!-- Prompt the user to input between 0 and 10-->
      	<td>Enter an integer 0 - 10</td>
        <!-- Create the form for input-->
      	<td><input type="text" name="integer" id="integer" size = "10" value="<?php echo $integer; ?>" /></td>
      </tr>  	
      <tr>
        <!-- Initialize the compute button for the user--> 
      	<td><input type="submit" name="compute" id="compute" value="Compute" /></td>
      	<!-- Initialize the reset button for the user--> 
        <td><input type="reset" name="resetButton" id="resetButton" value="Reset" /></td>
      </tr>				
      </table>
</form>
<?php
}
// If the compute button is pressed or the integer is between 0 and 10 output the following
elseif (!isset($_GET['compute']) || ($integer >= 0 && $integer <= 10)) {
    // Thank the user for visiting our website
    echo "<h2>Thank you for using the Factorial Calculator</h2>";
    // Output their result
    echo "The factorial of " . $integer . " is " . $output;
    // Add a link for them to compute another factorial
    echo "<p><a href=\"Q2FactorialCalculator.php\">Try again?</a></p>\n";
}
?>
</body>
</html>