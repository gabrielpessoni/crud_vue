<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$servidor = "localhost"; $usuario = "root"; $contrasenha = ""; $nomeBaseDados = "clientes";
$conexaoBD = new mysqli($servidor, $usuario, $contrasenha, $nomeBaseDados);

if (isset($_GET["consultar"])){
    $sqlClientes = mysqli_query($conexaoBD,"SELECT * FROM clientes WHERE id=".$_GET["consultar"]);
    if(mysqli_num_rows($sqlClientes) > 0){
        $clientes = mysqli_fetch_all($sqlClientes,MYSQLI_ASSOC);
        echo json_encode($clientes);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}

if (isset($_GET["excluir"])){
    $sqlClientes = mysqli_query($conexaoBD,"DELETE FROM clientes WHERE id=".$_GET["excluir"]);
    if($sqlClientes){
        echo json_encode(["success"=>1]);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}

if(isset($_GET["inserir"])){
    $data = json_decode(file_get_contents("php://input"));
    $nome=$data->nome;
    $endereco=$data->endereco;
        if(($endereco!="")&&($nome!="")){
            
    $sqlClientes = mysqli_query($conexaoBD,"INSERT INTO clientes(nome,endereco) VALUES('$nome','$endereco') ");
    echo json_encode(["success"=>1]);
        }
    exit();
}

if(isset($_GET["atualizar"])){
    
    $data = json_decode(file_get_contents("php://input"));

    $id=(isset($data->id))?$data->id:$_GET["atualizar"];
    $nome=$data->nome;
    $endereco=$data->endereco;
    
    $sqlClientes = mysqli_query($conexaoBD,"UPDATE clientes SET nome='$nome',endereco='$endereco' WHERE id='$id'");
    echo json_encode(["success"=>1]);
    exit();
}

$sqlClientes = mysqli_query($conexaoBD,"SELECT * FROM clientes ");
if(mysqli_num_rows($sqlClientes) > 0){
    $clientes = mysqli_fetch_all($sqlClientes,MYSQLI_ASSOC);
    echo json_encode($clientes);
}
else{ echo json_encode([["success"=>0]]); }


?>
