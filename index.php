<?php
	$files_error = "";
	$file_dest_html = "html/index.html";
	if(!empty($_FILES)){
		$file_name = $_FILES['fichier']['name'];
		$file_extension = strrchr($file_name, ".");
		$file_tmp_name = $_FILES['fichier']['tmp_name'];

		$extensions_autorisees = array('.md', '.MD');
		$file_dest = "md/$file_name";


		if(in_array($file_extension, $extensions_autorisees)){
			if(move_uploaded_file($file_tmp_name, $file_dest)){
				shell_exec("python py/convert.py $file_name -o $file_dest_html");
				header('Refresh: 2;URL=..');
			} else {
				$files_error = "Error";
			}
		} else {
			$files_error = "Seulement les fichiers MD sont acceptés";
		}
	}		

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
    <meta lang="fr" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>Markdown to HTML</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="includes/css/styles.css">
	<link rel="stylesheet" href="includes/css/prism.css">
</head>
<body>
	<h1 class="text-center align-middle">Markdown to HTML</h1>
	<form method="post" action="" enctype="multipart/form-data">
		<div class="upload-btn-wrapper">
			<button class="btn">Upload a file</button>
			<input type="file" name="fichier" id="md" accept=".md">
		</div>
		<div>
			<button class="btn-submit btn-success">Submit</button>
		</div>
	</form><br/>
		<?php if($files_error && $files_error){
			echo '<div class="alert alert-warning text-center" role="alert">'; 
			echo $files_error.'</div>';
		}
		?>
	<div class="language-html">
	<?php 
			$fichierR =  fopen("$file_dest_html","r");
			echo '<pre class="language-html code" ><code>';
			while(!feof($fichierR)){
				$convert = fgets($fichierR);
				$text = htmlentities($convert);
				echo $text;
			}
			echo '</pre></code>';
			fclose($fichierR)
		?>
	</div>
	<script src="includes/js/prism.js"></script>
</body>
</html>