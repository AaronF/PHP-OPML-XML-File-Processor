<?php
//?Very basic function to get the file extenstion
function getExtension($filename) {
	return substr(strrchr($filename,'.'),1);
}

if (($_FILES["file"]["type"] == "text/xml") && getExtension($_FILES["file"]["name"])==".xml") xor getExtension($_FILES["file"]["name"])==".opml")
{
	echo "Error: " . $_FILES["file"]["error"] . "<br>";
}
else
{
	if (file_exists($_FILES["file"]["tmp_name"])) {
	    $import = simplexml_load_file($_FILES["file"]["tmp_name"]);
	 
		foreach($import->body->outline as $feed){
			
			// Here you could run through each and insert them into a database of some kind (may not be the most efficient but it would work)
			
			echo($feed["title"]);// This is to extract the title of each entry
			echo"<br>";
			echo($feed["xmlUrl"]);// This is to extract the url from each entry
			echo"<br><br>";
			// You can change these to look for what you want, just use the same code as above and extract what you want
	    }
	} else {
	    exit('Failed to open.');
	}
}
?>