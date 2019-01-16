<?php
	if(!empty($_FILES)){
		$file_name = $_FILES['fichier']['name'];
		$file_extension = strrchr($file_name, ".");
		$file_tmp_name = $_FILES['fichier']['tmp_name'];

		$extensions_autorisees = array('.md', '.MD');
		$file_dest = '../md/'.$file_name;

		if(in_array($file_extension, $extensions_autorisees)){
			if(move_uploaded_file($file_tmp_name, $file_dest)){
				echo 'Files upload success!';
			} else {
				echo 'Error';
			}
		} else {
			echo 'Seuls les fichiers MD sont autorisés !';
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
    <meta lang="fr" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Markdown to HTML</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="include/styles.css">
</head>
<body>
	<h1 class="text-center align-middle">Markdown to HTML</h1>
	<form method="post" action="" enctype="multipart/form-data">
		<div>
			<label for="file"><input type="file" name="fichier" id="md" value="Select a File" accept=".md"></label>
		</div>
		<div>
			<button>Submit</button>	
		</div>
	</form>
</body>
</html>