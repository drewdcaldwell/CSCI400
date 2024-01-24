<!DOCTYPE html>

<!--
     Lab 1 for CSCI-C400 Client-Server Web Programming.
     Drew Caldwell       1/24/2024           IU-Kokomo

     The purpose of this program is to use an HTMl form to obtain user input about
     a specific course, and input their grade obtained. The course and grade values 
     will be passed through various php loops to determine if the course is a valid
     course for the program, and whether the grade is a passing grade for the respective
     class.

     ** The reset button would not work within the html code, so I initialized a javascript
     function that when the reset button clicks, will clear the html forms with empty values.
 -->


<html>
<head>
<meta charset = "utf-8" />
<title>Course Pass/Fail Calculator</title></head>
<body>

<?php
// Declare the Variables

// This boolean will determine if the forms need to be displayed.
$displayForm = TRUE;
// Course Name variable will be a string given by the user.
$courseName = "";
// Grade will be a float that will be provided by the user.
$grade = "";

//isset(var): Returns TRUE if var exists and has value other than NULL, it returns FALSE otherwise.  
if (isset($_GET['calculate'])) {
     $courseName = strval($_GET["courseName"]);
	$grade = floatval($_GET["grade"]);
	 
     //Check if the  Course Name is empty and prompt user if so.
     //Also check if grade is numeric. If not, prompt for a new grade value
     if (empty($courseName) or !is_numeric($grade)){
	 	echo "Both Course ID and a numeric value for Grade are required";
     }

	// Check if the grade form is between o and 100. If it is not, prompt the user to input a valid grade.
     else if( $grade < 0 or $grade > 100){
          echo "Your grade value must be between 0 and 100!";
     }

     // Check if the course name is csci343 or csci400. If not, prompt the user to enter a valid course.
     else if (strtolower($courseName) != "csci400" && strtolower($courseName) != "csci343") {
          echo "Please enter a valid course. Course CSCI400 or CSCI343";}

     // Compare the string and grade, to determine whether they have failed the respective class.
     else if((strtolower($courseName) == "csci400" and $grade < 70) or (strtolower($courseName) == "csci343" and $grade < 75)){
          echo '<pre style="color: red;">';
          echo 'You Failed!!';
          echo '</pre>'; }

     // Compare the string and grade, to determine whether they have passed the respective class.     
     else if((strtolower($courseName) == "csci400" and $grade >= 70) or (strtolower($courseName) == "csci343" and $grade >= 75)){
          echo '<pre style="color: green;">';
          echo 'You Passed!!';
          echo '</pre>'; }

     // Do not display form if none of these match
	else{
          $displayForm = false;
     }
}



// We will display the form as long as we have recieved an appropriate output.
if ($displayForm) {
?>
<form action="Lab1_Caldwell.php" method="get">
      <table border="0">
      <tr>
      	<td>Enter Course ID</td>
      	<td><input type="text" name="courseName" id="courseName" size = "10" value="<?php echo $courseName; ?>" />
          <!-- value =  echo (isset($courseName)) ? $courseName : '';?>"</td> -->
      </tr>  
      <tr>
      	<td>Enter Grade</td>
      	<td><input type="text" name="grade" id="grade" size = "10" value="<?php echo $grade; ?>"/></td>
      </tr>		
      <tr>
          <!-- Create the submit button to be able to see if the class was passed or failed.-->
      	<td><input type="submit" name="calculate" id="calculate" value="calculate" /></td>

          <!-- Reset Button that uses a javascript function to continually work
          I was having problems in the browser but this addition fixed it. -->
      	<td><input type="button" onclick="resetForm()" value="Reset" /></td>
      </tr>				
      </table>
</form>
<?php
}


else {
     // Output incase the program has an error. This should never run, but incase it does there is a prompt.
     echo "You have reached the end of the program. To go back Please click on the link.";
     echo "<p><a href=\"Lab1_Caldwell.php\">Try again?</a></p>\n";
}
?>

<!-- JavaScript function to be able to reset the forms consistently -->
<script>
function resetForm() {
    document.getElementById("courseName").value = "";
    document.getElementById("grade").value = "";
}
</script>

</body>
</html>
