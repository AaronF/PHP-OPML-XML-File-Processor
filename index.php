<!doctype html>
<html>
<head>
	<title>Import Test</title>
</head>
<body>
<h1>PHP OPML/XML File Parser</h1>
<p>This is a basic OPML/XML parser that can be used to process the opml export from the likes of Google Reader. Right now this is setup to work with the subscriptions.xml output from Google Reader but can be adjusted for any other type of exported file.</p>
<form action="importer.php" method="post" enctype="multipart/form-data" id="importform">
	<label for="file">Choose File:</label>
	<input type="file" name="file" id="file"><br>
	<input type="submit" name="importsubmit" value="Submit">
</form>
</body>
</html>