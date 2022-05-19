<?php 


/* Criando a CLASSE 'Pessoa'*/
class Pessoa{
    
    //A propiedade 'pdo' onde será insanciando a classe PDO, que fará a conexão com o banco de dados.
    //PRIVATE:: Este modificador é o mais restrito. Com ele definimos que somente a própria classe em que um atributo ou método foi declarado pode acessá-lo. Ou seja, nenhuma outra parte do código, nem mesmo as classes filhas, pode acessar esse atributo ou método.
    private $pdo;


    //A partir do momento que for executado a classe o primeiro código que será instanciado será o construtor.
    //Conexão com o Banco de Dados
    public function __construct($dbname,$host, $user,$pass)
    {
        try
        {
            $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host, $user,$pass);
            //echo "Conexão realizada com sucesso!";
        }

        catch (PDOException $errosdb) 
        {
            echo "Erro no banco de dados!<br>".$errosdb;  
            exit();
        }

        catch(PDOException $errosgr)
        {
            echo "Erro geral!<br> " .$errosgr;
            exit();
        }
    }


    //Método utilizado para buscar os dados 'SELECT'.
    public function buscarDados()
    {
        $resultado = array ();
        $select = $this->pdo->query("SELECT * FROM pessoa ORDER BY nome");
        $resultado = $select->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

    //Método utilizado para buscar inserir dados 'INSERT'.
    public function cadastrarUsuario($nome, $telefone, $email)
    {
        //Antes de cadastrar vamos verificar se já possui os dados cadastrados.
        $insert = $this->pdo->prepare("SELECT id FROM pessoa WHERE email = :email");
        $insert->bindValue(":email",$email);
        $insert->execute();
        if($insert->rowCount() > 0)//Email já existe no banco
        {
            return false;     
        } 
        
        else //Não foi encontrado o e-mail
        {
          $insert = $this->pdo->prepare("INSERT INTO pessoa (nome, telefone, email) VALUES (:nome, :telefone, :email)"); 
          $insert->bindValue(":nome",$nome);
          $insert->bindValue(":telefone",$telefone);
          $insert->bindValue(":email",$email);
          $insert->execute();
          return true;
        }
    }

    //Médoto utilizado para excluir uma pessoa do BANCO DE DADOS.
    public function deletarUsuario($id)
    {
        $delete = $this->pdo->prepare("DELETE FROM pessoa WHERE id = :id");
        $delete->bindValue(":id", $id);
        $delete->execute();
    }

    //Método utilizado para buscar os dados de uma pessoas especifíca no banco de dados.
    public function buscarDadosUsuario($id)
    {
        $resultado = [];        
        $select = $this->pdo->prepare("SELECT * FROM pessoa WHERE id = :id");     
        $select->bindValue(":id",$id);
        $select->execute(); 
        $resultado = $select->fetch(PDO::FETCH_ASSOC);
        return $resultado;
    }

    //Método utilizado para atualizar as informações no banco de dados.
    public function atualizarDados($id, $nome, $telefone, $email)
    
    {   
        $update = $this->pdo->prepare("UPDATE pessoa SET nome = :nome, telefone = :telefone, email = :email WHERE id = :id");
        $update->bindValue(":nome", $nome);
        $update->bindValue(":telefone", $telefone);
        $update->bindValue(":email", $email);
        $update->bindValue(":id", $id);
        $update->execute();
    }
    
}




?>