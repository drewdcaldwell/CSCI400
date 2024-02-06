<!DOCTYPE html>

<!--
    Q3 New England State Capitals Quiz CSCI-C400    2/5/2024
    Drew Caldwell                   IU - Kokomo

    The purpose of this code is to be able to create a sort of quiz using forms and php code to validate
    the users answers. This code looks at some New England state capitals and allows the user to input answers
    for each and gain immediate feedback on how they answered the question to each state, how many they got correct,
    and the percentage that they got correct. 

    The quiz after giving feedback, allows the user to press a try again button for them to try the quiz again
    unless they get all of the answers correct.
-->
<html>
<head>
    <meta charset="utf-8" />
    <title>Civics Quiz</title>
</head>
<body>
    <h3>Civics Quiz - New England State Capitals</h3>

    <?php
	// correct count, this is used to calculate the number of correct answers the user inputted.
    $correct = 0;
	// Associative array of states with there capitals
    $stateCapitals = array(
        "Connecticut" => "Hartford",
        "Maine" => "Augusta",
        "Massachusetts" => "Boston",
        "NewHampshire" => "Concord",
        "RhodeIsland" => "Providence",
        "Vermont" => "Montpelier"
    );

    // Check if the form should be displayed or not
    $displayForm = !isset($_POST['send']) || isset($_POST['tryAgain']);

	// If the check answers button is pressed, display the results of the state capitals individually
	// Then display the percentage of question correctly answered using displaystats
    if (isset($_POST['send'])) {
        displayResults($stateCapitals);
        displayStats($correct);
    }

	// displayResults will show the user individually how they answered each states capital and if it was correct or not
	function displayResults($stateCapitals)
    {
        global $correct;
        $answersArray = array(
            "Connecticut" => isset($_POST['Connecticut']) ? trim($_POST['Connecticut']) : '',
            "Maine" => isset($_POST['Maine']) ? trim($_POST['Maine']) : '',
            "Massachusetts" => isset($_POST['Massachusetts']) ? trim($_POST['Massachusetts']) : '',
            "NewHampshire" => isset($_POST['NewHampshire']) ? trim($_POST['NewHampshire']) : '',
            "RhodeIsland" => isset($_POST['RhodeIsland']) ? trim($_POST['RhodeIsland']) : '',
            "Vermont" => isset($_POST['Vermont']) ? trim($_POST['Vermont']) : ''
        );

		//display whether they answered correct, incorrect, or no value at all
        foreach ($answersArray as $state => $response) {
            if (strlen($response) > 0) {
                if (strcasecmp($stateCapitals[$state], $response) == 0) {
                    echo "<p> Correct! The capital of $state is {$stateCapitals[$state]}</p>";
                    $correct++;
                } else {
                    echo "<p>Sorry! The capital of $state is not $response.</p>";
                }
            } else {
                echo "<p>You did not enter a value for $state</p>";
            }
        }
    }

	// displaystats will tell us how many questions the user answered correctly as a number and a percentage.
	// it will also allow the user to have a "Try Again" button that will bring the forms back so that they may answer again
	function displayStats($correct)
    {
        global $stateCapitals;
        $percentage = round($correct / count($stateCapitals), 2) * 100;
        echo "<p>You answered $correct correct questions. Your score is $percentage%</p>";

        // Display Try Again button only if not all answers are correct
        if ($correct != count($stateCapitals)) {
            echo '<form action="" method="post">';
            echo '<input type="submit" name="tryAgain" value="Try Again" />';
            echo '</form>';
        }
    }
    ?>


	<!--
		Display the forms, the submit button and the reset button.
		The reset never worked for me but hopefully it can on a different device.
-->
    <?php if ($displayForm) { ?>
        <form action="" method="post">

            <table border="0">
                <tr>
                    <td><label for="Connecticut">The capital of Connecticut is: </label></td>
                    <td><input type="text" name="Connecticut" id="Connecticut" size="25" /></td>
                </tr>
                <tr>
                    <td><label for="Maine">The capital of Maine is: </label></td>
                    <td><input type="text" name="Maine" id="Maine" size="25" /></td>
                </tr>
                <tr>
                    <td><label for="Massachusetts">The capital of Massachusetts is: </label></td>
                    <td><input type="text" name="Massachusetts" id="Massachusetts" size="25" /></td>
                </tr>
                <tr>
                    <td><label for="NewHampshire">The capital of New Hampshire is: </label></td>
                    <td><input type="text" name="NewHampshire" id="NewHampshire" size="25" /></td>
                </tr>
                <tr>
                    <td><label for="RhodeIsland">The capital of Rhode Island is: </label></td>
                    <td><input type="text" name="RhodeIsland" id="RhodeIsland" size="25" /></td>
                </tr>
                <tr>
                    <td><label for="Vermont">The capital of Vermont is: </label></td>
                    <td><input type="text" name="Vermont" id="Vermont" size="25" /></td>
                </tr>
                <tr>
                    <td><input type="submit" name="send" id="submitButton" value="Check Answers" />&nbsp;&nbsp;&nbsp;
                        <input type="reset" name="resetButton" id="resetButton" value="Clear Form" /></td>
                </tr>
            </table>

        </form>
    <?php } ?>
</body>
</html>
