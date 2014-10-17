<?php
//Very basic function to get the file extenstion (.xml)
function getExtension($filename) {
	return substr(strrchr($filename,'.'),1);
}
?>
<h1>Results:</h1>
<?php
if ($_FILES["file"]["type"] == "text/xml" && getExtension($_FILES["file"]["name"])==".xml" || getExtension($_FILES["file"]["name"])==".opml"){
	echo "Error: " . $_FILES["file"]["error"] . "<br>";
} else {
	if (file_exists($_FILES["file"]["tmp_name"])) {
	    	$import = simplexml_load_file($_FILES["file"]["tmp_name"]);
	 
		if($import->body->outline){
			foreach($import->body->outline as $feedtop){
				if(!$feedtop->outline) {
					//top level feeds
					echo($feedtop["title"]);// Extract the title of each entry
					echo"<br>";
					echo($feedtop["xmlUrl"]);// Extract the url from each entry
					echo"<br><br>";
				} else {
					foreach($feedtop->outline as $feed){
						//this part should be able to display any feeds that are buried within a folder
						//untested but should work
						echo($feed["title"]);
						echo"<br>";
						echo($feed["xmlUrl"]);
						echo"<br><br>";
				    }
				}
			}
		} 

		
	} else {
		// No file exists
	    	exit('Failed to open'.$_FILES["file"]["name"]);
	}
}
?>
