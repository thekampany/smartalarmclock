
<?php

if(isset($_POST['btn-addtoday']))
{
	$myfile = fopen("alarmholiday.txt", "a") or die("Unable to open file!");
	$txt = date("Y-m-d");
	fwrite($myfile, "\n". $txt);
	fclose($myfile);
}
if(isset($_POST['btn-addtomorrow']))
{
        $myfile = fopen("alarmholiday.txt", "a") or die("Unable to open file!");
        $txt = date("Y-m-d", strtotime("+1 day"));
        fwrite($myfile, "\n". $txt);
        fclose($myfile);
}

if(isset($_POST['btn-addspecific']))
{
	$starttxt = date_create($_POST['suppress-start']);
	$endtxt = date_create($_POST['suppress-end']);
	$diff = date_diff($starttxt,$endtxt);
	$txt = $starttxt;
	if ($diff->format("%a") >= 0){
	        $myfile = fopen("alarmholiday.txt", "a") or die("Unable to open file!");
		for ($x=0;$x<=$diff->format("%a");$x++){
			fwrite($myfile, "\n".date_format($txt, "Y-m-d"));
			$txt = date_add($txt,date_interval_create_from_date_string("1 day"));
		}
        	fclose($myfile);
	}
}

if(isset($_POST['btn-addrecurring']))
{
        $myfile = fopen("alarmholiday.txt", "a") or die("Unable to open file!");
        $txt = $_POST['suppress-recurring'];
        fwrite($myfile, "\n". $txt);
        fclose($myfile);
}
if(isset($_POST['btn-removetoday']))
{
	 $DELETE = date("Y-m-d");
	 $data = file("alarmholiday.txt");
	 $out = array();

	 foreach($data as $line) {
     		if(trim($line) != $DELETE) {
     		    $out[] = $line;
     		}
 	 }
	 $fp = fopen("alarmholiday.txt", "w+");
	 flock($fp, LOCK_EX);
	 foreach($out as $line) {
	    if (strlen($line) > 1){
     	       fwrite($fp, $line);
	    }
 	 }
	 flock($fp, LOCK_UN);
 	 fclose($fp); 
}
if(isset($_POST['btn-removetomorrow']))
{
         $DELETE = date("Y-m-d", strtotime("+1 day"));
         $data = file("alarmholiday.txt");
         $out = array();

         foreach($data as $line) {
                if(trim($line) != $DELETE) {
                    $out[] = $line;
                }
         }
         $fp = fopen("alarmholiday.txt", "w+");
         flock($fp, LOCK_EX);
         foreach($out as $line) {
	    if (strlen($line) >1){
	       fwrite($fp, $line);
	    }
         }
         flock($fp, LOCK_UN);
         fclose($fp);
}

if(isset($_POST['btn-removeall']))
{
         $data = file("alarmholiday.txt");
         $out = array();

         foreach($data as $line) {
                if(strlen($line) <7) {
                    $out[] = $line;
                }
         }
         $fp = fopen("alarmholiday.txt", "w+");
         flock($fp, LOCK_EX);
         foreach($out as $line) {
            fwrite($fp, $line);
         }
         flock($fp, LOCK_UN);
         fclose($fp);
}



?>

<!DOCTYPE html>
<html class="no-js">

    <head>
        <title>AlarmclockSettings</title>
        <!-- Bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="assets/styles.css" rel="stylesheet" media="screen">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

    </head>

    <body>


    <div class="container" style="background-repeat: no-repeat;  background-position: right top;  background-size:400px;">

        <form method="post">
        <h2 class="form-signin-heading">Alarmclock - Set days without alarm</h2><hr />

	<button class="btn btn-large btn-primary" type="submit" name="btn-addtoday">Add Today</button>
        <button class="btn btn-large btn-primary" type="submit" name="btn-addtomorrow">Add Tomorrow</button>
        <br><br>
        Add Specific Date or Period<br>
        <input type="date" id="start" name="suppress-start">
	<input type="date" id="end" name="suppress-end">
        <button class="btn btn-large btn-primary" type="submit" name="btn-addspecific">Submit</button>
        <br><br>
        Add Yearly Recurring Date (mm-dd)<br>
        <input type="text" id="suprec" name="suppress-recurring">
        <button class="btn btn-large btn-primary" type="submit" name="btn-addrecurring">Submit</button>
 	<br><br>
        <button class="btn btn-large btn-primary" type="submit" name="btn-removetoday">Remove Today</button>
        <button class="btn btn-large btn-primary" type="submit" name="btn-removetomorrow">Remove Tomorrow</button>
        <button class="btn btn-large btn-primary" type="submit" name="btn-removeall">Remove All non recurring</button>

        <br><br>


	<?php
	$handle = fopen("alarmholiday.txt", "r");
	if ($handle) {
	    while (($line = fgets($handle)) !== false) {
	        echo $line."<br>";
	    }
	    fclose($handle);
	} else {
	    // error opening the file.
	    echo "error";
	}
	?>

	</form>
    </div>
        <!--/.fluid-container-->
        <script src="bootstrap/js/jquery-2.0.4.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/scripts.js"></script>
        
    </body>

</html>

