<?php 
spl_autoload_register();
error_reporting(0);

use App\Task;

function select($i)
{
	if (empty($_GET) || !isset($_GET['tr']))
		return false;
	if ($_GET['tr'] == $i)
	{
		return 'selected';
	}
	return null;
}

function spsel()
{
	if (empty($_GET) || !isset($_GET['tr']))
		return 'selected';
	return false;
}

if (!empty($_POST))

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/> 
	<title>Calendar</title>
	<h1><font face="Palatino Linotype"><i>Asterisk</i></font></h1>
	<style>
		table{
			background-color: rgba(255,255,255,0.7);
		}

		a{
			color: black;
			text-decoration: none;
		}
		a:hover{
			text-decoration: underline;
		}
	</style>
</head>
<body background="https://img3.badfon.ru/original/1600x900/3/9e/cvetok-vetka-vaza-boke-belyy.jpg">
	<h2 align="center"><font face="CALIBRI"><i>Список aбонентов</i></font></h2>
 	<table border = 1 align="center" width=100%>
 		<tr>
 			<th><font face="CALIBRI">Номер</font></th>
 			<th><font face="CALIBRI">Лицевой счёт</font></th>
 			<th><font face="CALIBRI">Баланс</font></th>
            <th><font face="CALIBRI">Удаление</font></th>
 		</tr>
 		<?php
            $task = new Task;
            if (!empty($_GET) && $_GET['del'] == true) {
                $task->del($_GET['id']);
            }
            echo $task->read_to_db();
                 
 		?>
 	</table>
 	<form action="new_task.php">
 		<p align="right"><input type="submit" value="Добавить задачу"></p>
 	</form>
</body>
</html>
