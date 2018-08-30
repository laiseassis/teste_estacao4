<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <script src="js/bootstrap.min.js"></script>
        <script type="text/javascript">
			function somenteNumeros(num) {
				var er = /[^0-9,.]/;
				er.lastIndex = 0;
				var campo = num;
				if (er.test(campo.value)) {
				  campo.value = "";
				}
			}
		</script>
    </head>
    
    <body>
        <div class="container">
            <div clas="span10 offset1">
                <div class="row">
                    <h3 class="well"> Cadastro </h3>
                    <form class="form-horizontal" action="cad_produto.php" method="post">
                        
                        <div class="control-group <?php echo !empty($nomeErro)?'error ' : '';?>">
                            <label class="control-label">Nome</label>
                            <div class="controls">
                                <input size= "50" name="txt_nome" type="text" placeholder="Nome" required value="<?php echo !empty($nome)?$nome: '';?>">
                                <?php if(!empty($nomeErro)): ?>
                                    <span class="help-inline"><?php echo $nomeErro;?></span>
                                <?php endif;?>
                            </div>
                        </div>
                        
                        <div class="control-group <?php echo !empty($descricaoErro)?'error ': '';?>">
                            <label class="control-label">Descrição</label>
                            <div class="controls">
                            	<textarea name="txt_descricao" placeholder="Descrição" required><?php echo !empty($descricao)?$descricao: '';?></textarea>
                                <?php if(!empty($descricaoErro)): ?>
                                <span class="help-inline"><?php echo $descricaoErro;?></span>
                                <?php endif;?>
                        	</div>
                        </div>
                        
                        <div class="control-group <?php echo !empty($precoErro)?'error ': '';?>">
                            <label class="control-label">Preço</label>
                            <div class="controls">
                                <input size="35" name="txt_preco" type="text" placeholder="Preço" required value="<?php echo !empty($preco)?$preco: '';?>" onKeyUp="somenteNumeros(this);">
                                <?php if(!empty($precoErro)): ?>
                                <span class="help-inline"><?php echo $precoErro;?></span>
                                <?php endif;?>
                        	</div>
                        </div>
                        <div class="form-actions">
                            <br/>
                
                            <button type="submit" class="btn btn-success">Cadastrar</button>
                            <a href="index.php" type="btn" class="btn btn-default">Voltar</a>
                        
                        </div>
                    </form>
                </div>
        </div>
    </body>
</html>


<?php
    require 'conexao_banco.php';
    
    if(!empty($_POST))
    {
        $nomeErro = null;
        $descricaoErro = null;
        $precoErro = null;
        
        $nome = $_POST['txt_nome'];
        $descricao = $_POST['txt_descricao'];
        $preco = str_replace(",",".",$_POST['txt_preco']);
        
        $validacao = true;
        if(empty($nome)){
            $nomeErro = 'Digite o nome do produto!';
            $validacao = false;
        }
        
        if(empty($descricao)){
            $descricaoErro = 'Digite a descrição do produto!';
            $validacao = false;
        }
        
        if(empty($preco)){
            $precoErro = 'Digite o preço do produto!';
            $validacao = false;
        }
        
        if($validacao){
            $pdo = Conexao::conect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO tb_produtos (nm_produto, desc_produto, preco_produto) VALUES(?,?,?)";
			$a = $pdo->prepare($sql);
            $a->execute(array($nome,$descricao,$preco));
			
            Conexao::desconect();
            header("Location: index.php");
        }
    }
?>
