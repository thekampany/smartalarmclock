
<?php

if(isset($_POST['btn-update']))
{
	//save the file
	if( !empty( $_POST ) ){
		// convert form data to json format
		if ($_POST['AlarmEnabled0'] =="on"){$AlarmEnabled0 = "True";} else { $AlarmEnabled0= "False";}
                if ($_POST['AlarmEnabled1'] =="on"){$AlarmEnabled1 = "True";} else { $AlarmEnabled1= "False";}
                if ($_POST['AlarmEnabled2'] =="on"){$AlarmEnabled2 = "True";} else { $AlarmEnabled2= "False";}
                if ($_POST['AlarmEnabled3'] =="on"){$AlarmEnabled3 = "True";} else { $AlarmEnabled3= "False";}
                if ($_POST['AlarmEnabled4'] =="on"){$AlarmEnabled4 = "True";} else { $AlarmEnabled4= "False";}
                if ($_POST['AlarmEnabled5'] =="on"){$AlarmEnabled5 = "True";} else { $AlarmEnabled5= "False";}
                if ($_POST['AlarmEnabled6'] =="on"){$AlarmEnabled6 = "True";} else { $AlarmEnabled6= "False";}

    		$postArray0 = array(
      		"AlarmDay" => $_POST['AlarmDay0'],
      		"AlarmDayEnabled" => $AlarmEnabled0,
      		"AlarmTime" => $_POST['AlarmTime0'],
      		"AlarmMethod" => $_POST['AlarmMethod0'],
		"AlarmMethodValue" => $_POST['AlarmMethodValue0']
		);
                $postArray1 = array(
                "AlarmDay" => $_POST['AlarmDay1'],
                "AlarmDayEnabled" => $AlarmEnabled1,
                "AlarmTime" => $_POST['AlarmTime1'],
                "AlarmMethod" => $_POST['AlarmMethod1'],
                "AlarmMethodValue" => $_POST['AlarmMethodValue1']
	    	);
                $postArray2 = array(
                "AlarmDay" => $_POST['AlarmDay2'],
                "AlarmDayEnabled" => $AlarmEnabled2,
                "AlarmTime" => $_POST['AlarmTime2'],
                "AlarmMethod" => $_POST['AlarmMethod2'],
                "AlarmMethodValue" => $_POST['AlarmMethodValue2']
                );
                $postArray3 = array(
                "AlarmDay" => $_POST['AlarmDay3'],
                "AlarmDayEnabled" => $AlarmEnabled3,
                "AlarmTime" => $_POST['AlarmTime3'],
                "AlarmMethod" => $_POST['AlarmMethod3'],
                "AlarmMethodValue" => $_POST['AlarmMethodValue3']
                );
                $postArray4 = array(
                "AlarmDay" => $_POST['AlarmDay4'],
                "AlarmDayEnabled" => $AlarmEnabled4,
                "AlarmTime" => $_POST['AlarmTime4'],
                "AlarmMethod" => $_POST['AlarmMethod4'],
                "AlarmMethodValue" => $_POST['AlarmMethodValue4']
                );
                $postArray5 = array(
                "AlarmDay" => $_POST['AlarmDay5'],
                "AlarmDayEnabled" => $AlarmEnabled5,
                "AlarmTime" => $_POST['AlarmTime5'],
                "AlarmMethod" => $_POST['AlarmMethod5'],
                "AlarmMethodValue" => $_POST['AlarmMethodValue5']
                );
                $postArray6 = array(
                "AlarmDay" => $_POST['AlarmDay6'],
                "AlarmDayEnabled" => $AlarmEnabled6,
                "AlarmTime" => $_POST['AlarmTime6'],
                "AlarmMethod" => $_POST['AlarmMethod6'],
                "AlarmMethodValue" => $_POST['AlarmMethodValue6']
                );

	$alarmdetailsarray = array($postArray0,$postArray1,$postArray2, $postArray3, $postArray4, $postArray5,$postArray6);
	$alarmconfigarray = array("Alarmdetails" => $alarmdetailsarray);
	$json = json_encode ($alarmconfigarray);
	//echo $json;
	$file = 'alarm.conf.json';
	file_put_contents( $file, $json);
	}
}
//else
//{
// go get the alarm config file

$url = 'alarm.conf.json'; // path to your JSON file
$data = file_get_contents($url); // put the contents of the file into a variable
$alarmdetails = json_decode($data,true); // decode the JSON feed


//get mpd playlists

//show data on the form

//}
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
        <h2 class="form-signin-heading">Alarmclock Settings</h2><hr />

        <table border ="0" cellspacing="10">
	<tr>
	<td>Day</td>
	<td>On Off</td>
	<td>Time</td>
	<td>Method</td>
	<td>Playlist</td>
	</tr>
        <tr>
        <td>Monday <input type="hidden" name="AlarmDay0" value="0"></td>
	<td><input type="checkbox" name="AlarmEnabled0" <?php if($alarmdetails['Alarmdetails'][0]['AlarmDayEnabled']=='True') {echo 'checked';} ?> ></td>
	<td><input type="text" name="AlarmTime0" value="<?php echo $alarmdetails['Alarmdetails'][0]['AlarmTime'];?>" size="6" /></td>
	<td><select name="AlarmMethod0">
		<option value="MPDPlaylist" <?php if($alarmdetails['Alarmdetails'][0]['AlarmMethod'] =='MPDPlaylist'){echo "SELECTED";} ?> >MPDPlaylist</option>
                <option value="MPDUrl" <?php if($alarmdetails['Alarmdetails'][0]['AlarmMethod'] =='MPDUrl'){echo "SELECTED";} ?> >MPDUrl</option>
	</select>
        <td><input type="text" name="AlarmMethodValue0" value="<?php echo $alarmdetails['Alarmdetails'][0]['AlarmMethodValue'];?>" /></td>
	</tr>
        <tr>
        <td>Tuesday <input type="hidden" name="AlarmDay1" value="1"></td>
        <td><input type="checkbox" name="AlarmEnabled1" <?php if($alarmdetails['Alarmdetails'][1]['AlarmDayEnabled']=='True') {echo 'checked';} ?> ></td>
        <td><input type="text" name="AlarmTime1" value="<?php echo $alarmdetails['Alarmdetails'][1]['AlarmTime'];?>" size="6" /></td>
        <td><select name="AlarmMethod1">
                <option value="MPDPlaylist" <?php if($alarmdetails['Alarmdetails'][1]['AlarmMethod'] =='MPDPlaylist'){echo "SELECTED";} ?> >MPDPlaylist</option>
                <option value="MPDUrl" <?php if($alarmdetails['Alarmdetails'][1]['AlarmMethod'] =='MPDUrl'){echo "SELECTED";} ?> >MPDUrl</option>
        </select>
        <td><input type="text" name="AlarmMethodValue1" value="<?php echo $alarmdetails['Alarmdetails'][1]['AlarmMethodValue'];?>" /></td>
        </tr>
        <tr>
        <td>Wednesday <input type="hidden" name="AlarmDay2" value="2"></td>
        <td><input type="checkbox" name="AlarmEnabled2" <?php if($alarmdetails['Alarmdetails'][2]['AlarmDayEnabled']=='True') {echo 'checked';} ?> ></td>
        <td><input type="text" name="AlarmTime2" value="<?php echo $alarmdetails['Alarmdetails'][2]['AlarmTime'];?>" size="6" /></td>
        <td><select name="AlarmMethod2">
                <option value="MPDPlaylist" <?php if($alarmdetails['Alarmdetails'][2]['AlarmMethod'] =='MPDPlaylist'){echo "SELECTED";} ?> >MPDPlaylist</option>
                <option value="MPDUrl" <?php if($alarmdetails['Alarmdetails'][2]['AlarmMethod'] =='MPDUrl'){echo "SELECTED";} ?> >MPDUrl</option>
        </select>
        <td><input type="text" name="AlarmMethodValue2" value="<?php echo $alarmdetails['Alarmdetails'][2]['AlarmMethodValue'];?>" /></td>
        </tr>
        <tr>
        <td>Thursday <input type="hidden" name="AlarmDay3" value="3"></td>
        <td><input type="checkbox" name="AlarmEnabled3" <?php if($alarmdetails['Alarmdetails'][3]['AlarmDayEnabled']=='True') {echo 'checked';} ?> ></td>
        <td><input type="text" name="AlarmTime3" value="<?php echo $alarmdetails['Alarmdetails'][3]['AlarmTime'];?>" size="6" /></td>
        <td><select name="AlarmMethod3">
                <option value="MPDPlaylist" <?php if($alarmdetails['Alarmdetails'][3]['AlarmMethod'] =='MPDPlaylist'){echo "SELECTED";} ?> >MPDPlaylist</option>
                <option value="MPDUrl" <?php if($alarmdetails['Alarmdetails'][3]['AlarmMethod'] =='MPDUrl'){echo "SELECTED";} ?> >MPDUrl</option>
        </select>
        <td><input type="text" name="AlarmMethodValue3" value="<?php echo $alarmdetails['Alarmdetails'][3]['AlarmMethodValue'];?>" /></td>
        </tr>
        <tr>
        <td>Friday <input type="hidden" name="AlarmDay4" value="4"></td>
        <td><input type="checkbox" name="AlarmEnabled4" <?php if($alarmdetails['Alarmdetails'][4]['AlarmDayEnabled']=='True') {echo 'checked';} ?> ></td>
        <td><input type="text" name="AlarmTime4" value="<?php echo $alarmdetails['Alarmdetails'][4]['AlarmTime'];?>" size="6" /></td>
        <td><select name="AlarmMethod4">
                <option value="MPDPlaylist" <?php if($alarmdetails['Alarmdetails'][4]['AlarmMethod'] =='MPDPlaylist'){echo "SELECTED";} ?> >MPDPlaylist</option>
                <option value="MPDUrl" <?php if($alarmdetails['Alarmdetails'][4]['AlarmMethod'] =='MPDUrl'){echo "SELECTED";} ?> >MPDUrl</option>
        </select>
        <td><input type="text" name="AlarmMethodValue4" value="<?php echo $alarmdetails['Alarmdetails'][4]['AlarmMethodValue'];?>" /></td>
        </tr>
        <tr>
        <td>Saturday <input type="hidden" name="AlarmDay5" value="5"></td>
        <td><input type="checkbox" name="AlarmEnabled5" <?php if($alarmdetails['Alarmdetails'][5]['AlarmDayEnabled']=='True') {echo 'checked';} ?> ></td>
        <td><input type="text" name="AlarmTime5" value="<?php echo $alarmdetails['Alarmdetails'][5]['AlarmTime'];?>" size="6" /></td>
        <td><select name="AlarmMethod5">
                <option value="MPDPlaylist" <?php if($alarmdetails['Alarmdetails'][5]['AlarmMethod'] =='MPDPlaylist'){echo "SELECTED";} ?> >MPDPlaylist</option>
                <option value="MPDUrl" <?php if($alarmdetails['Alarmdetails'][5]['AlarmMethod'] =='MPDUrl'){echo "SELECTED";} ?> >MPDUrl</option>
        </select>
        <td><input type="text" name="AlarmMethodValue5" value="<?php echo $alarmdetails['Alarmdetails'][5]['AlarmMethodValue'];?>" /></td>
        </tr>
        <tr>
        <td>Sunday <input type="hidden" name="AlarmDay6" value="6"></td>
        <td><input type="checkbox" name="AlarmEnabled6" <?php if($alarmdetails['Alarmdetails'][6]['AlarmDayEnabled']=='True') {echo 'checked';} ?> ></td>
        <td><input type="text" name="AlarmTime6" value="<?php echo $alarmdetails['Alarmdetails'][6]['AlarmTime'];?>" size="6" /></td>
        <td><select name="AlarmMethod6">
                <option value="MPDPlaylist" <?php if($alarmdetails['Alarmdetails'][6]['AlarmMethod'] =='MPDPlaylist'){echo "SELECTED";} ?> >MPDPlaylist</option>
                <option value="MPDUrl" <?php if($alarmdetails['Alarmdetails'][6]['AlarmMethod'] =='MPDUrl'){echo "SELECTED";} ?> >MPDUrl</option>
        </select>
        <td><input type="text" name="AlarmMethodValue6" value="<?php echo $alarmdetails['Alarmdetails'][6]['AlarmMethodValue'];?>" /></td>
        </tr>
        </tr>
       </table>
      <hr />
        <button class="btn btn-large btn-primary" type="submit" name="btn-update">Update</button>
      <hr />

       </div>

        
        <!--/.fluid-container-->
        <script src="bootstrap/js/jquery-1.9.1.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/scripts.js"></script>
        
    </body>

</html>

