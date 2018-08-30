<?php 
	
	require 'conexao_banco.php';

	$id = null;
	if (!empty($_GET['id'])){
		$id = $_REQUEST['id'];
    }
	
	if (null==$id){
		header("Location: index.php");
    }
	
	if (!empty($_POST)){
		
		$nomeErro = null;
		$descricaoErro = null;
		$precoErro = null;
		
		$nome = $_POST['txt_nome'];
		$descricao = $_POST['txt_descricao'];
		$preco = $_POST['txt_preco'];
		
		//Validação
		$validacao = true;
		if (empty($nome)){
			$nomeErro = 'Digite o nome do produto!';
			$validacao = false;
		}
		
		if (empty($descricao)){
			$descricaoErro = 'Digite a descrição do produto!';
			$validacao = false;
		}
                
        if (empty($preco)){
			$precoErro = 'Digite o preço do produto!';
			$validacao = false;
		}
		
		// update data
		if ($validacao){
			$pdo = Conexao::conect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE tb_produtos set nm_produto = ?, desc_produto = ?, preco_produto = ? WHERE id_produto = ?";
			$a = $pdo->prepare($sql);
			$a->execute(array($nome,$descricao,$preco,$id));
			Conexao::desconect();
			header("Location: index.php");
		}
	}else{
        $pdo = Conexao::conect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM tb_produtos where id_produto = ?";
		$a = $pdo->prepare($sql);
		$a->execute(array($id));
		$dados = $a->fetch(PDO::FETCH_ASSOC);
		$nome = $dados['nm_produto'];
        $descricao = $dados['desc_produto'];
        $preco = $dados['preco_produto'];
		Conexao::desconect();
	}
?>


<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <link   href="css/bootstrap.min.css" rel="stylesheet">
        <script src="js/bootstrap.min.js"></script>
    </head>
     
    <body>
        <div class="container">
            <div class="span10 offset1">
                <div class="row">
                    <h3 class="well"> Atualizar Contato </h3>
                </div>
         
                <form class="form-horizontal" action="alt_produto.php?id=<?php echo $id?>" method="post">
                    <div class="control-group <?php echo !empty($nomeErro)?'error':'';?>">
                        <label class="control-label">Nome</label>
                        <div class="controls">
                            <input name="txt_nome" size="50" maxlength="50" type="text"  placeholder="Nome" value="<?php echo !empty($nome)?$nome:'';?>">
                            <?php if (!empty($nomeErro)): ?>
                                <span class="help-inline"><?php echo $nomeErro;?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="control-group <?php echo !empty($descricaoErro)?'error':'';?>">
                        <label class="control-label">Descricao</label>
                        <div class="controls">
                            <textarea name="txt_descricao" placeholder="Descrição" required><?php echo !empty($descricao)?$descricao: '';?></textarea>
                            <?php if (!empty($descricaoErro)): ?>
                                <span class="help-inline"><?php echo $enderecoErro;?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="control-group <?php echo !empty($precoErro)?'error':'';?>">
                        <label class="control-label">Preço</label>
                        <div class="controls">
                            <input name="txt_preco" size="30" type="text"  placeholder="Preço" value="<?php echo !empty($preco)?$preco:'';?>">
                            <?php if (!empty($precoErro)): ?>
                                <span class="help-inline"><?php echo $precoErro;?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <br/>
                    
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success">Atualizar</button>
                        <a href="index.php" type="btn" class="btn btn-default">Voltar</a>
                    </div>
                </form>
			</div>                 
		</div> 
	</body>
</html>

