<?php 

    //Fazendo a chamada da classe 'Pessoa.php' através do require_once.
    require_once 'Pessoa.php';

    //Instanciando a CLASSE 'Pessoa.php' e passando os parametros da conexão através do __construct.
    //Parametros: dbname, host(host de conexão), usuário e senha.
    $pessoa = new Pessoa("crudpdo","localhost","root","");

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>CRUDPDO</title>
</head>
<body>

<?php 

    //Se existe dentro do formulário $_POST o botão btn-login.
    if(isset($_POST['btn-login']))
    {   
        //--------------------ATUALIZAR-----------------------------
        //Se existe a variavel GET o id_update e ela não estiver vazia. Se for verdade...
        if(isset($_GET['id_update']) && !empty($_GET['id_update']))
        {   
            //As variaveis abaixo receberão os dados preenchidos no formulário via $_GET e $_POST.
            $id_update = addslashes($_GET['id_update']);
            $nome      = addslashes(strtoupper($_POST['nome']));
            $telefone  = addslashes(strtoupper($_POST['telefone']));
            $email     = addslashes(mb_strtolower($_POST['email']));
            
            //Se os campos: $nome, $telefone e $email não estiverem vazios.
            if(!empty($nome) && !empty($telefone) && !empty($email))
            {
            //Chamaremos a função atualizarDados da classe 'Pessoa'. Para que os dados sejam atualizados.
            $pessoa->atualizarDados($id_update, $nome, $telefone, $email);
            echo "<script>
                    alert('\\nDados atualizados com sucesso!\\n\\nNOME: $nome \\nTELEFONE: $telefone \\nEMAIL: $email');
                    window.location.href='index.php';
                    </script>";
            
            }
            else
            {
                echo "<script>
                    alert('MENSAGEM: Para cadastrar um novo usuário é necessário preencher todos os dados!');
                    window.location.href='index.php';
                    </script>";
                
            }
        }
    
        //-----------------------CADASTRAR------------------------------
        else
        {
            $nome     = addslashes(strtoupper($_POST['nome']));
            $telefone = addslashes(strtoupper($_POST['telefone']));
            $email    = addslashes(mb_strtolower($_POST['email']));
            
            //Se os campos: $nome, $telefone e $email não estiverem vazios.
            if(!empty($nome) && !empty($telefone) && !empty($email))
            {
                //Chamando a função cadastrar da classe $pessoa
                if($pessoa->cadastrarUsuario($nome, $telefone,$email))
                {
                    echo "<script>
                            alert('\\nUsuário cadastrado com sucesso!\\n\\nNOME: $nome \\nTELEFONE: $telefone \\nEMAIL: $email');
                            window.location.href='index.php';
                        </script>";
                    
                }
                else
                {
                    echo "<script>
                            alert('ERRO: O email infomado ( $email ) já foi cadasatrado em outro usuário.\\n');
                            window.location.href='index.php';
                        </script>";
                    
                }
                
            }
            else 
            {
                echo "<script>
                    alert('\\nALERTA: Para cadastrar um novo usuário é necessário o preenchimento de todos os campos!');
                    window.location.href='index.php';
                </script>";
                
            }
        }
    }



?>
<?php 
    if(isset($_GET['id_update']))
    {
        $id_update = addslashes(($_GET['id_update']));
        $resultado = $pessoa->buscarDadosUsuario($id_update);
    }
?>


    <main class="container">
        
        <section class="first">
            <img src="logo-responsivo.png" alt="logo-fecap">

            <h1><?php if(isset($resultado)){echo "Editar Usuário";} else{echo "Cadastrar Usuário";}?></h1>
            <form class="form" method="POST">

                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome"
                value="<?php if(isset($resultado)){echo $resultado['nome'];} ?>">

                <label for="telefone">Telefone</label>
                <input type="text" name="telefone" id="telefone" 
                value="<?php if(isset($resultado)){echo $resultado['telefone'];} ?>">
                
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required
                value="<?php if(isset($resultado)){echo $resultado['email'];} ?>"><br>

                <input class="btn-login" name="btn-login" type="submit" value="<?php if(isset($resultado)){echo "Atualizar";}else{echo "Cadastrar";} ?>"><br>
            </form>
        </section>
        
        <section class="second">
              <table>
                     <tr>
                        <th>NOME</th>
                        <th>TELEFONE</th>
                        <th>EMAIL</th>
                        <th>AÇÕES</th>
                    </tr>
            <?php 
             $dados = $pessoa->buscarDados();
             if(count($dados) > 0) //Se o número de usuários no banco for maior que 'Zero'
             {
                for($i = 0; $i < count($dados); $i++)
                {
                    echo "<tr>";
                    foreach($dados[$i] as $keys => $value) 
                    {
                       if($keys != "id") 
                       {
                        echo "<td>".$value."</td>";
                       }
                    }
            ?>        
                    <td>
                        <a class="button" name="editar" id="editar" href="index.php?id_update=<?php echo $dados[$i]['id']?>">Editar</a>
                        <a class="button" name="cancelar" id="cancelar" href="index.php">Cancelar</a>
                        <a class="button" name="excluir" id="excluir" href="index.php?id=<?php echo $dados[$i]['id'];?>">Excluir</a>
                        
                    </td>
            <?php
                    echo "</tr>";
                }
             }
            ?>

            </table>
        </section>
    </main>

</body>

</html>


<?php 

if(isset($_GET['id']))
    {
      $id_pessoa =  addslashes($_GET['id']);
      $pessoa->deletarUsuario($id_pessoa);
      echo "<script>
                alert('\\nDados deletados com sucesso!');
                window.location.href='index.php';
            </script>";
    }
?>