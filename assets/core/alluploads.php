<?php
include 'layout/head.php';

if(isset($_POST['import'])){
		echo $filename=$_FILES["file"]["tmp_name"];
		 if($_FILES["file"]["size"] > 0) {

		  	$file = fopen($filename, "r");
	         while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE){
	          //It wiil insert a row to our subject table from our csv file`
	           $sql = $database->query_db("INSERT into lecturer (`lecID`, `firstName`) values('$emapData[1]','$emapData[0]')");
	         //we are using mysql_query function. it returns a resource on true else False on error
	          //$result = $db->sql( $sql);

	         }
	         fclose($file);
	         //throws a message if data successfully imported to mysql database from excel file
	         echo "<script type=\"text/javascript\">
						alert(\"CSV File has been successfully Imported.\");
						window.location = \"dashboard.php\"
					</script>";
			 //close of connection
//			mysql_close($conn);
		 }
}
?>

<div class="col-md-10 content">
    <div class="panel panel-default">
        <div class="panel-heading">Create Multiple Lecturer.</div>
        <div class="panel-body">
            <div class="row text-center" style="padding:10px;">
                <div class="col-md-12 ">
                    <form class="form-horizontal well" method="post" name="upload_excel" enctype="multipart/form-data">
                    CSV/Excel File:<input type="file" name="file" id="file" class="input-large form-control">
                    <br>
                    <button type="submit" id="submit" name="import" class="btn btn-primary button-loading" data-loading-text="Loading...">Upload</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <h4 class="text-center text-danger"> Format For CSV File Upload</h4>
            </div>
        </div>

    </div>
</div>
