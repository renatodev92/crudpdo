<?php  


//------------------CONEXÃO COM O BANCO DE DADOS--------------------------

/* Criando a conexão com o banco de dados PDO */
//Para criar a conexão com o banco de dados, teremos que instanciar a classe PDO e passar alguns parametros no construtor para realizar a conexão.

//Criando a variavel 'pdo' e instanciando a classe 'PDO'.
//Passando os parametros no construtor. (dbname, hostname,usuario e senha)
//Podemos ter vários erros com a conexão com o banco de dados, para que possamos visualizar os erros podemos usar o 'try cath' para retornar as exceções/erros, caso a conexão com o banco de dados não de certo.


/* try{ 
    $pdo = new PDO("mysql:dbname=CRUDPDO;host=localhost","root","");
    //echo "Conexão realizada com Sucesso!";
}catch(PDOException $errosdb){
       echo "Erro com o banco de dados: <br>".$errosdb->getMessage(); 
}catch(PDOException $errosgr){
       echo "Erro geral!<br> " .$errosgr->getMessage();
};
 */
//-----------------------INSERT-----------------------------
//Temos os dois métodos para utilizar o insert.

/* //1° Forma através do método prepare da classe 'PDO'.

$resultado = $pdo->prepare("INSERT INTO pessoa(nome, telefone, email) VALUES(:nome, :telefone, :email)");


//bindValue - Aceita valores passados diretamente e também funções.

$resultado->bindValue(":n", "Renato de Oliveira");
$resultado->bindValue(":t", "1190000-0000");
$resultado->bindValeu(":email", "renato.oliveira@fecap.br");
$resultado->execute();

/* //Bindparam -- Só aceita váriaveis, não aceita nomes diretamente.
$resultado->bindparam(":nome", $nome);//Só aceita váriaveis.
$nome = "Renato de Oliveira"; */

/* //2° Forma: Podemos inserir os dados diretamente através da query.
$resultado = $pdo->query("INSERT INTO pessoa(nome, telefone, email) VALUES('Renan Maia de Carvalho', '954816957', 'renan-contato@hotmail.com')"); */


//----------------------- DELETE -----------------------------

//1° Forma

/* 
$delete = $pdo->prepare("DELETE FROM pessoa WHERE id = :id");
$id = 123;
$delete->bindValue(":id", $id);
$delete->execute();
echo "Os dados foram deletados com sucesso! ".$id; */


/* //2° Forma
$delete = $pdo->query("DELETE FROM pessoa WHERE id = '3'");
echo "Informações deletadas com sucesso!" */


//----------------------- UPDATE -----------------------------


// 1° Forma através do método 'prepare';
/* $update = $pdo->prepare("UPDATE pessoa SET email = :email WHERE id = :id");
$id = 11;Butantã, São Paulo - SP
$email = "miriam@gmail.com";
$update->bindValue(":id", $id);
$update->bindValue(":email", $email);
$update->execute();
echo "Os dados foram atualizados com Sucesso!"; */



 //2° Forma atarvés do método 'query'
/* $update = $pdo->query("UPDATE pessoa SET nome = 'Maria de Lourdes' WHERE id = '1'"); 
echo "Os dados foram atualizados com Sucesso!";  */


//----------------------- SELECT -----------------------------

//1° Forma através do método 'prepare';
/* $select = $pdo->prepare("SELECT nome, telefone, email FROM pessoa WHERE id = :id");
$id = 124;
$select->bindValue(":id", $id);
$select->execute(); */

//Tranformando os dados retornados do banco de dados em um array.
//Você pode utilizar 2 funcões.
// fetch() retorna apenas 1 registro do banco de dados.
// fetchAll() retorna mais que 1 resgistro no banco de dados.


//Criando uma variavel para receber a informação do banco de dados e tranformala em um array.
// A função fecth nos da 2 opções para se trabalhar. o nome da coluna do banco de dados e a posição do indíce.
//Execute o comando abaixo para visualizar.

/* echo "<pre>";
$resultado = $select->fetch();
echo "<pre>";

print_r($resultado); */

/* //Iremos trabalhar com o PDO::FETCH_ASSOC que retornará o nome dos campos ao invés do número de índice. 

echo "<pre>";
$resultado = $select->fetch(PDO::FETCH_ASSOC);
echo "<pre>";

//Agora usaremos o foreach para percorrer os dados que iremos receber do banco.

foreach ($resultado as $key => $value){
       echo $key.":".$value."<br>";
}

/* print_r($resultado); */












?>