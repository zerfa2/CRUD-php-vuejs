<?php 

require_once "global.php";

$conexion = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);

if($conexion->connect_error){
	die("Error al conectarse a la base de datos - ".mysqli_connect_error());
}

$res = array('error'=>false);
$action = 'read';

if(isset($_GET['action'])){
	$action = $_GET['action'];
}
if($action == "read"){
	$query = $conexion->query("SELECT * FROM students");
	$students = [];
	while ($rspta = $query->fetch_assoc()) {
		array_push($students,$rspta);
	}
	$res["students"]=$students;
}

if($action =="create"){
	$name = isset($_POST["name"]) ? $_POST["name"] : "";
	$email = isset($_POST["email"]) ? $_POST["email"] : "";
	$web = isset($_POST["web"]) ? $_POST["web"] : "";
	$query = $conexion->query("INSERT INTO students(name,email,web) VALUES('$name','$email','$web')");
	if($query){
		$res["message"] = "Estudiante agregado con exito";
	}else{
		$res["error"] = true;
		$res["message"] = "Error al agregar al estudiante";

	}

}
if($action=="update"){
	$idstudent = isset($_POST["idstudent"]) ? $_POST["idstudent"] : "";
	$name = isset($_POST["name"]) ? $_POST["name"] : "";
	$email = isset($_POST["email"]) ? $_POST["email"] : "";
	$web = isset($_POST["web"]) ? $_POST["web"] : "";
	$query = $conexion->query("UPDATE students SET name= '$name', email='$email',web='$web' WHERE idstudent='$idstudent'");
	if($query){
		$res["message"] = "Estudiante actualizado con exito";

	}else{
		$res["error"] = true;
		$res["message"] = "Error al actualizar al estudiante";
	}
}

if($action == "delete"){
	$idstudent = isset($_POST["idstudent"]) ? $_POST["idstudent"] : "";
	$query = $conexion->query("DELETE FROM  students WHERE idstudent = '$idstudent'");
	if($query){

		$res["message"] = "Estudiante eliminar con exito";
	}else{
		$res["error"] = true;
		$res["message"] = "Error al eliminar al estudiante";
	}
}

$conexion->close();
header( 'Content-type: application/json' );
echo json_encode($res);
