<!DOCTYPE html>

<!--
Question 1 HW1_P2 CSCI-C400 Client-Server Web Programming
Drew Caldwell       1/28/2024           IU-Kokomo

This code allows the user to input the number of hours they did for either jogging,
biking, or swimming, then after pressing submit, calculates the total number of calories lost, 
and the total number of pounds lost by doing the excercise.
 -->
<html>
<head>
    <meta charset="utf-8" />
    <title>Weight Loss Calculator</title>
</head>
<body>

<?php
// Display the form
$displayForm = true;

// Initialize the input variables for the user to give us
$hoursBiking = 0;
$hoursJogging = 0;
$hoursSwimming = 0;


// Define the variables for the number of calories burned PER hour of activity
$bikeCalories = 200;
$jogCalories = 475;
$swimCalories = 275;


// Initialize some variables that we need for the computations of total calories burned and the total number of pounds lost
$caloriesPerPound = 3500;
$caloriesLost = 0;
$poundsLost = 0;

// If the "calculate" button is pressed, execute this code
if (isset($_GET['calculate'])) {
    // Get the values from our forms
    $hoursBiking = floatval($_GET["hoursbike"]);
    $hoursJogging = floatval($_GET["hoursjog"]);
    $hoursSwimming = floatval($_GET["hoursswim"]);

    // Ensure that the input is an actual hours amount. In order for this form to execute, at least one activity must be done.
    if ($hoursBiking < 0 || $hoursJogging < 0 || $hoursSwimming < 0) {
        // Prompt user for a real input
        echo "Please enter non-negative values for hours.";
    } else {
        // Calculate the total number of calories lost
        $caloriesLost = ($bikeCalories * $hoursBiking + $jogCalories * $hoursJogging + $swimCalories * $hoursSwimming);
        // Calculate the total number of pounds lost
        $poundsLost = $caloriesLost / $caloriesPerPound;
        // After completing the formulas, hide the form to give the user the summary output.
        $displayForm = false;
    }
}

if ($displayForm) {
    ?>
    <form action="Q1WeightLossCalculator.php" method="get">
        <table border="0">
            <tr>
                <!-- Initialize the form to get the total number of hours biked -->
                <td>Enter number of hours biking </td>
                <td><input type="text" name="hoursbike" id="hoursbike" size="10" value="<?php echo $hoursBiking; ?>" /></td>
            </tr>
            <tr>
                <!-- Initialize the form to get the total number of hours jogged -->
                <td>Enter number of hours jogging</td>
                <td><input type="text" name="hoursjog" id="hoursjog" size="10" value="<?php echo $hoursJogging; ?>" /></td>
            </tr>
            <tr>
                <!-- Initialize the form to get the total number of hours swam -->
                <td>Enter number of hours swimming</td>
                <td><input type="text" name="hoursswim" id="hoursswim" size="10" value="<?php echo $hoursSwimming; ?>" /></td>
            </tr>
            <tr>
                <!-- Initialize the calculate button, upon being pressed, $caloriesLost will be computed and the $poundsLost will be computed in order
            to be displayed in a summary for the user. -->
                <td><input type="submit" name="calculate" id="calculate" value="Compute" /></td>
                <!-- The reset button for the user to be able to backtrack the form and be able to put new values in if an error has occured in the initial steps.-->
                <td><input type="reset" name="resetButton" id="resetButton" value="Reset" /></td>
            </tr>
        </table>
    </form>
    <?php
} else {
    ?>
    <h2>Thank you for using the Weight Loss Calculator</h2>
    <p>Number of calories burned is <?php echo round($caloriesLost,2); ?></p>
    <p>Number of pounds worked off is <?php echo round($poundsLost,2); ?></p>
    <form action="Q1WeightLossCalculator.php" method="get">
        <input type="submit" name="startOver" value="Start Over">
    </form>
    <?php
}
?>
</body>
</html>
