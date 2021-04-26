<?php
// SET HEADER
//header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// INCLUDING DATABASE AND MAKING OBJECT
require 'database.php';
$db_connection = new Database();
$conn = $db_connection->dbConnection();

// GET DATA FORM REQUEST

$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$valor = $_POST['valor'];
$categoria = $_POST['categoria'];


//CREATE MESSAGE ARRAY AND SET EMPTY
$msg['message'] = '';

// CHECK IF RECEIVED DATA FROM THE REQUEST
if(isset($nombre) && isset($descripcion) && isset($valor ) && isset($categoria )){
    // CHECK DATA VALUE IS EMPTY OR NOT
    if(!empty($nombre) && !empty($descripcion) && !empty($valor) && isset($categoria )){
        
        $insert_query = "INSERT INTO `productos`(nombre,descripcion,valor,categoria) VALUES(:nombre,:descripcion,:valor,:categoria)";
        
        $insert_stmt = $conn->prepare($insert_query);
        // DATA BINDING
        $insert_stmt->bindValue(':nombre', htmlspecialchars(strip_tags($nombre)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':descripcion', htmlspecialchars(strip_tags($descripcion)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':valor', htmlspecialchars(strip_tags($valor)),PDO::PARAM_INT);
        $insert_stmt->bindValue(':categoria', htmlspecialchars(strip_tags($categoria)),PDO::PARAM_STR);
        if($insert_stmt->execute()){
            $msg['message'] = 'Data Inserted Successfully';
        }else{
            $msg['message'] = 'Data not Inserted';
        } 
        
    }else{
        $msg['message'] = 'Oops! empty field detected. Please fill all the fields';
    }
}
else{
    $msg['message'] = 'Please fill all the fields | title, body, author';
}
//ECHO DATA IN JSON FORMAT
echo  json_encode($msg);
?>