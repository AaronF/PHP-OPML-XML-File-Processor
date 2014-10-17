<?php
//Get the file extension (we want .xml but that check comes later)
function getExtension($filename) {
	return substr(strrchr($filename,'.'),1);
}
?>
<h1>Results:</h1>
<?php
if ($_FILES["file"]["type"] == "text/xml" && getExtension($_FILES["file"]["name"])==".xml" || getExtension($_FILES["file"]["name"])==".opml"){
	//Incorrect file type
	echo "Error: " . $_FILES["file"]["error"] . "<br>";
} else {
	//Correct file, proceed to parse
	if (file_exists($_FILES["file"]["tmp_name"])) {
		//Here we are using PHP's 'built in' SimpleXML function, but the principle is the same across most of them
	    	$import = simplexml_load_file($_FILES["file"]["tmp_name"]);
	 
	 	//This was specific to the layout of the Google Reader export
		if($import->body->outline){
			foreach($import->body->outline as $feedtop){
				if(!$feedtop->outline) {
					//top level feeds
					echo($feedtop["title"]);// Extract the title of each entry (Google Reader)
					echo"<br>";
					echo($feedtop["xmlUrl"]);// Extract the url from each entry (Google Reader)
					echo"<br><br>";
				} else {
					foreach($feedtop->outline as $feed){
						//This should show nested feeds (within folders)
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
