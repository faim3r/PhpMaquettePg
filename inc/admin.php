<?php
session_start();
//si l'utilisateur admin est connecté:
if(isset($_SESSION['id']) AND ($_SESSION['role'] == 'ROLE_ADMIN')){
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
</head>
<body>





</body>
</html>
<?php
}
?>
