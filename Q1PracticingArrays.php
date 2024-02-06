<!DOCTYPE html>

<!--
Q1 Practicing Arrays in PHP HW_2 2/4/2024
Drew Caldwell       CSCI-C400       IU-Kokomo

The purpose of this program is to experience sequential search by manually 
sorting through an array to see if a certain value is within the data.
In our case we have 5 different courses that are available and want to see if the
one we input is within the available courses array.
-->

<html>
   <head>
      <meta charset = "utf-8" />
      <title>Practing Arrays in PHP</title>
	  <link rel="stylesheet" type="text/css" href="common.css" />
   </head>

   <body>
      <h3>
      <?php
// Array of different course offerings
$courses = ["C400", "I262", "C343", "I400", "I211"];

// Function to perform the sequential search of the course in the array courses
function sequentialSearch($searchCourse, $array) {
    foreach ($array as $course) {
        if ($course == $searchCourse) {
// Return true if the course is found
            return true; 
        }
    }
// return false if the course is not found in the array
    return false; 
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchCourse = $_POST["course"];

    // Basic form validation
    if (!empty($searchCourse)) {
        $result = sequentialSearch($searchCourse, $courses);

        // Display result message
        if ($result) {
            // Display if the course is within the courses array
            echo "<p>Course $searchCourse is available.</p>";
        } else {
            // Display if the course is not in the courses array.
            echo "<p>Course $searchCourse is not available.</p>";
        }
    } else {
        // Prompt the user to enter a course ID
        // At this point of the loop the ID has been submitted and is empty.
        echo "<p>Please enter a course ID.</p>";
    }
}
?>

<!-- Initialize the form for user input -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="course">Enter Course ID:</label>
    <input type="text" id="course" name="course">
    <input type="submit" value="Search">
</form>
      </h3>
   </body>
</html>