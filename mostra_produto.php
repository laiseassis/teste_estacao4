<?php
    require 'conexao_banco.php';
    $id = null;
    if(!empty($_GET['id'])){
        $id = $_REQUEST['id'];
    }
    
    if(null==$id){
        header("Location: index.php");
    }else{
       $pdo = Conexao::conect();
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       $sql = "SELECT * FROM tb_produtos where id_produto = ?";
       $a = $pdo->prepare($sql);
       $a->execute(array($id));
       $dados = $a->fetch(PDO::FETCH_ASSOC);
       Conexao::desconect();
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
                    <h3 class="well"> Listar Produtos </h3>
                </div>
                
                <div class="form-horizontal">                   
                    <div class="control-group">
                        <label class="control-label">Nome</label>
                        <div class="controls">
                            <label class="carousel-inner">
                                <?php echo $dados['nm_produto'];?>
                            </label>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label">Descrição</label>
                        <div class="controls">
                            <label class="carousel-inner">
                                <?php echo $dados['desc_produto'];?>
                            </label>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label">Preço</label>
                        <div class="controls">
                            <label class="carousel-inner">
                                <?php echo $dados['preco_produto'];?>
                            </label>
                        </div>
                    </div>
                   
                    <br/>
                    <div class="form-actions">
                        <a href="index.php" type="btn" class="btn btn-default">Voltar</a>
                    </div>
                    
                </div>
            </div>
        </div>
    </body>
</html>

