<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <script src="js/bootstrap.min.js"></script>
    </head>
    
    <body>
        <div class="jumbotron">
            <div class="container">
                <div class="row">
                    <p>
                        <a href="cad_produto.php" class="btn btn-success">Cadastrar</a>
                    </p>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Preço</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $apresenta = '';
                            
                            include 'conexao_banco.php';
                            $pdo = Conexao::conect();
                            $sql = 'SELECT * FROM tb_produtos ORDER BY nm_produto';
                            
                            foreach($pdo->query($sql)as $dados){
                                $apresenta .= '
                                    <tr>
                                        <td>'. $dados['id_produto'] .'</td>
                                        <td>'. $dados['nm_produto'] .'</td>
                                        <td>'. $dados['desc_produto'] .'</td>
                                        <td>'. $dados['preco_produto'] .'</td>
                                        <td width="250">
                                            <a class="btn btn-primary" href="mostra_produto.php?id='.$dados['id_produto'].'">Listar</a>
                                            <a class="btn btn-warning" href="alt_produto.php?id='.$dados['id_produto'].'">Atualizar</a>
                                            <a class="btn btn-danger" href="del_produto.php?id='.$dados['id_produto'].'">Excluir</a>
                                        </td>
                                    </tr>
                                ';
                            }
                            
                            echo $apresenta;
                            Conexao::desconect();
                            ?>
                        </tbody>                   
                    </table>               
                </div>
            </div>
        </div>
    </body>
</html>
