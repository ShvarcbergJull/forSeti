<?php
spl_autoload_register();

use App\Task;
$task = new Task;
if (!empty($_POST) and empty($_GET))
{
	$task->insert();
}

if (!empty($_GET) and empty($_POST))
{
	$task->read_for_id($_GET['id']);
}

if (!empty($_GET) and !empty($_POST))
{
	if ($task->validate_two())
		$task->update_db();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Новый</title>
	<h1><font face="Palatino Linotype"><i>Asterisk</i></font></h1>
	<style>
		* {box-sizing: border-box;}
		.form-inner {padding: 50px;}
		.form-inner input,
		.form-inner textarea {
			display: block;
			width: 50%;
			padding: 0 20px;
			margin-left: auto;
			margin-right: auto;
			margin-bottom: 10px;
			background: #E9EFF6;
			line-height: 40px;
			border-width: 0;
			border-radius: 20px;
			font-family: 'Roboto', sans-serif;
		}
		.form-inner input[type="submit"] {
			width: 20%;
			margin-top: 30px;
			background: #FFC0CB;
			border-bottom: 4px solid #FFB6C1;
			font-size: 14px;
		}
		.form-inner input[type="date"]{
			color: #707981;
		}
		.form-inner input[type="time"]{
			color: #707981;
		}
		.form-inner select{
			margin-left: auto;
			margin-right: auto;
			display: block;
			width: 50%;
			height: 30px;
			padding: 0 20px;
			margin-bottom: 10px;
			background: #E9EFF6;
			line-height: 40px;
			border-width: 0;
			border-radius: 20px;
			font-family: 'Roboto', sans-serif;
			color: #707981;
		}
		.form-inner textarea {resize: none;}
		.form-inner h3 {
			margin-top: 0;
			font-family: 'Roboto', sans-serif;
			font-weight: 500;
			font-size: 24px;
			color: #707981;
		}
	</style>
</head>
<body background="https://img3.badfon.ru/original/1600x900/3/9e/cvetok-vetka-vaza-boke-belyy.jpg">	
	<form action="<?= $_SERVER['REQUEST_URI'];?>" method="POST" align="center" class="form-inner">
		    <h3><?php echo empty($_GET) ? 'Новый':'Изменение' ?></h3>
		    <input placeholder="Номер" name="sip" value="<?= isset($_POST['sip']) ? $_POST['sip']:''?>" required>
		    <input placeholder="Лицевой счёт" name="account" value="<?= isset($_POST['account']) ? $_POST['account']:''?>">
		    <input placeholder="Баланс" name="balance" value="<?= isset($_POST['balance']) ? $_POST['balance']:''?>">
		    <input type="submit" value="<?= empty($_GET) ? 'Добавить задачу':'Изменить' ?>">
	</form>
</body>
</html>
