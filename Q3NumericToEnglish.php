<!DOCTYPE html>

<!-- 
Question 3 HW1_P2 CSCI-C400 Client-Server Web Programming
Drew Caldwell       1/28/2024           IU-Kokomo

The purpose of this code is to take an integer input and convert the input, digit-by-digit,
into an english conversion for each digit.

The code utilizes a switch statement to find what digit it is currently on to get the correct output.
-->


<html>
<head>
    <meta charset="utf-8" />
    <title>Numeric to English Calculator</title>
</head>
<body>

<?php
// Display the form
$displayForm = true;
// Initialize the integer input variable
$integer = null;
// Initialize the output array. This will be what we store the strings with respect to digits
// to get our desired output
$array = array();

if (isset($_GET['compute'])) {
    // Verify that the integer input is valid, and if so, store it in the integer value
    $integer = isset($_GET["integer"]) ? intval($_GET["integer"]) : null;
    // Convert the integer value into a string value and store it in the $integerString variable
    $integerString = strval($integer);
    //  Get the length of the new string variable, and store it in the $integerLength variable
    $integerLength = strlen($integerString);

    // For each individual character within the length string, store the respective english
    // representation of each digit into the output array
    for ($i = 0; $i < $integerLength; $i++) {
        // initialize the digit for the switch case
        $digit = $integerString[$i];
        // implement the switch
        switch ($digit) {
            case '0':
                array_push($array, "Zero");
                break;
            case '1':
                array_push($array, "One");
                break;
            case '2':
                array_push($array, "Two");
                break;
            case '3':
                array_push($array, "Three");
                break;
            case '4':
                array_push($array, "Four");
                break;
            case '5':
                array_push($array, "Five");
                break;
            case '6':
                array_push($array, "Six");
                break;
            case '7':
                array_push($array, "Seven");
                break;
            case '8':
                array_push($array, "Eight");
                break;
            case '9':
                array_push($array, "Nine");
                break;
        }
    }
    // Set $displayForm to false to hide the form after computation
    $displayForm = false;
}

if ($displayForm) {
?>
<form action="Q3NumericToEnglish.php" method="get">
      <table border="0">
      <tr>
        <!-- Prompt the user to input an integer-->
      	<td>Enter an integer</td>
        <!-- Create the form for input-->
      	<td><input type="text" name="integer" id="integer" size="10" value="<?php echo $integer; ?>" /></td>
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
} else {
    // Print the resulting array vertically
    foreach ($array as $element) {
        // display an element, then line break
        echo $element . "<br>";
    }
    // Add a link for them to try again
    echo "<p><a href=\"Q3NumericToEnglish.php\">Try again?</a></p>\n";
}
?>
</body>
</html>
