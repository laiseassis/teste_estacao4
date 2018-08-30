<?php
require 'conexao_banco.php';

$id = 0;

if(!empty($_GET['id'])){
    $id = $_REQUEST['id'];
}

if(!empty($_POST)){
    $id = $_POST['id'];

	$pdo = Conexao::conect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM tb_produtos where id_produto = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    Conexao::desconect();
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="span10 offset1">
                <div class="row">
                    <h3 class="well">Excluir</h3>
                </div>
                <form class="form-horizontal" action="del_produto.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id;?>"/>
                    <div class="alert alert-danger"> Deseja excluir o produto?</div>
                    <div class="form actions">
                        <button type="submit" class="btn btn-danger">Sim</button>
                        <a href="index.php" type="btn" class="btn btn-default">Não</a>
                    </div>
                </form>
            </div>           
        </div>
    </body>    
</html>