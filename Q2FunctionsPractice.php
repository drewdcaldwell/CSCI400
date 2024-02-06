<!DOCTYPE html>

<!--
Q2 Practicing Functions in PHP HW_2 2/4/2024
Drew Caldwell       CSCI-C400       IU-Kokomo

The purpose of this program is to become familiar with functions in php.
Php functions are quite similar to java or python so it is not too bad to get done.
Here we are given an array and we are displaying, suming, and finding the maximum
numbers witin the array by calling defined functions that can do these tasks for us.
-->

<html>
   <head>
      <meta charset = "utf-8" />
      <title>Practing Functions in PHP</title>
	  <link rel="stylesheet" type="text/css" href="common.css" />
   </head>

   <body>
   <?php
// Function to display all elements in array
    function displayArray($array) {
        echo "Original Array: [" . implode(", ", $array) . "]<br>";
    }

// Function to initialize all of the elements to a particular value
    function initialize(&$array, $value) {
        for ($i = 0; $i < count($array); $i++) {
            $array[$i] = $value;
        }
    }

// Function to find and display the sum of elements
    function findSum($array) {
        $sum = array_sum($array);
        echo "Sum of Array Elements: $sum<br>";
    }

// Function to find and display the max number
    function findMax($array) {
        $max = max($array);
        echo "Maximum Element in Array: $max<br>";
    }

// Create and initialize the original array
    $originalArray = [5, 8, 12, 3, 9, 4, 7, 15, 2, 6];

// Call displayArray to display the original array
    displayArray($originalArray);

// Call findSum to find and display the sum of the original array
    findSum($originalArray);

// Call findMax to find and display the max element in the original array
    findMax($originalArray);

// Call initialize to initialize all array elements to 1.5
    initialize($originalArray, 1.5);

// Call displayArray to display the array after reinitialization
    displayArray($originalArray);

// Call findSum again to find the sum of the array after reinitialization
    findSum($originalArray);
?>
   </body>
</html>