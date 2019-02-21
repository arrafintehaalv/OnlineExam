
<?php
include 'dbh.inc.php';
/*if (isset($_POST['Start'])) {

	
	echo "";
}*/

$choice = "same";
$choiceErr = "";
$i = 0;
$correctAnswer = "same";
$marks = 0;
//echo $marks ."Line 14";
	
   		
   	



if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	if (empty($_POST["choice"])) {
    	$choiceErr = "choice is required";
  	}
  	else {
    	$choice = test_input($_POST["choice"]);
  	}

  	if (empty($_POST["i"])) {
    	echo "";
  	}
  	else {
    	$i = test_input($_POST["i"]);
  	}
  	
  	if (empty($_POST["correctAnswer"])) {
    	echo "";
  	}
  	else {
    	$correctAnswer = test_input($_POST["correctAnswer"]);
  	}

  	if (empty($_POST["marks"])) {
    	echo "";
  	}
  	else {
    	$marks = test_input($_POST["marks"]);
  	}
}

	if(strcasecmp($correctAnswer, $choice) == 0) {
		$marks++;
	}
	else {
	
	}


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


$sql = "SELECT question.qst, answer.a1, Answer.a2, answer.a3, answer.a4, answer.cans,question.qid
  FROM question
  INNER JOIN answer ON question.aid = answer.aid";

//$result = $conn->query($sql);
    // output data of each row

	//$q["i"]["a1"] = "";
	
    /*$i = 0;

    while($row = $result->fetch_assoc()) {?>

        <?php 
        /*
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
        <?php
        echo 'Question: ' .$row["qst"]. ' Options: ' ?>
        <input type="radio" name="choice" <?php if (isset($choice) && $choice== $row["a1"] ) echo "checked";?> value = <?php echo $row["a1"] ?> >
        <?php echo $row["a1"]; ?>
        <input type="radio" name="choice">
        <?php echo $row["a2"] ?>
        <input type="radio" name="choice">
        <?php echo $row["a3"] ?>
        <input type="radio" name="choice">
        <?php echo $row["a4"] .'<br>';?>
        <input type="submit" name="submit" value="Submit">

        </form>
        <?php 
   	 	echo $choice;
   	 	//$q["j"] = $q["i"];
   	 	$q[$i] = $row;
   	 	$i++;
   	 } */?>

   	 <?php 
   	 $result = $conn->query($sql);
   	 $allRows = $result->fetch_all();

   	 ?>

   	 <link rel="stylesheet" type="text/css" href="style.css">



   	<?php if($i < count($allRows)) { ?>

   	 <form class="login-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
   	 	<?php echo $allRows[$i][0] ?>
   	 	<input type="radio" name="choice" <?php if (isset($choice) && $choice == $allRows[$i][1] ) echo "checked";?> value = <?php echo $allRows[$i][1];?>>
   	 	<?php echo $allRows[$i][1];?>

   	 	<input type="radio" name="choice" <?php if (isset($choice) && $choice == $allRows[$i][2] ) echo "checked";?> value = <?php echo $allRows[$i][2];?>>
   	 	<?php echo $allRows[$i][2];?>

   	 	<input type="radio" name="choice" <?php if (isset($choice) && $choice == $allRows[$i][3] ) echo "checked";?> value = <?php echo $allRows[$i][3];?>>
   	 	<?php echo $allRows[$i][3];?>

   	 	<input type="radio" name="choice" <?php if (isset($choice) && $choice == $allRows[$i][4] ) echo "checked";?> value = <?php echo $allRows[$i][4];?>>
   	 	<?php echo $allRows[$i][4];?>

   	 	<input type="hidden" name="i" value="<?php echo $i + 1; ?>">

   	 	<input type = "hidden" name = "correctAnswer" value = "<?php echo $allRows[$i][5]; ?>">

   	 	<input type = "hidden" name = "marks" value = "<?php echo $marks; ?>">

  		


   	 	<input type="submit" name="submit" value="Submit">

   	 	 <h1><time></time></h1>
   	 	<a href="#" onClick="backAway()">Back</a>


   	 </form>

   	<?php }

   	else { 

   		$marks--;
   		echo "Quiz Finished <br>";
   		echo "Obtained Marks = " .$marks;?>
   		<form class="login-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
   			<input type="hidden" name="i" value="<?php 0 ?>">
 			 <a href="#" onClick="backAway()">Back</a>
 			   

   			<input type="submit" name="submit" value="Restart Exam">
   		</form>

   		<button id="flip">Show Answers</button>
   	<?php } ?>

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>

$(document).ready(function(){
    $("#flip").click(function(){
    	
        hello();
    });
});
	var showanswer = <?php echo json_encode($allRows); ?>;
	var row =  '<?php echo count($allRows)?>';
   		function hello()
   		{
   			
	   		for(var k = 0; k<row ;k++)
	   		{
	   			document.write('<div style="background-color: #129567;margin: 50px; text-align:center; font-size: 30px;">' + showanswer[k][6] + ". " + showanswer[k][0] + "<br> Answer: " + showanswer[k][5] + '</div>');
	   		}

	   		
   		}
</script>
