<?php  


//------------------CONEXÃO COM O BANCO DE DADOS--------------------------

/* Criando a conexão com o banco de dados PDO */
//Para criar a conexão com o banco de dados, teremos que instanciar a classe PDO e passar alguns parametros no construtor para realizar a conexão.

//Criando a variavel 'pdo' e instanciando a classe 'PDO'.
//Passando os parametros no construtor. (dbname, hostname,usuario e senha)
//Utilizaremos o try cath para retornar as exceções/erros, caso a conexão com o banco de dados não de certo.


/* try{
    $pdo = new PDO("mysql:dbname=CRUDPDO;host=localhost","root","");
    //echo "Conexão realizada com Sucesso!";
}catch(PDOException $errosdb){
       echo "Erro no banco de dados!<br>".$errosdb; 
}catch(PDOException $errosgr){
       echo "Erro geral!<br> " .$errosgr;
}; */

//-----------------------INSERT-----------------------------
//Temos os dois métodos para utilizar o insert.

/* //1° Forma
$resultado = $pdo->prepare("INSERT INTO pessoa(nome, telefone, email) VALUES(:nome, :telefone, :email)");


//Aceita valores passados diretamente e também funcções.
//Aceita valores passados diretamente.
$resultado->bindValue(":nome","Renato de Oliveira");
$resultado->bindValue(":telefone", "11959596707");
$resultado->bindValue(":email", "renato.roliveira92@gmail.com");
$resultado->execute(); */

/* //Bindparam -- Só aceita váriaveis, não aceita nomes diretamente.
$resultado->bindparam(":nome", $nome);//Só aceita váriaveis.
$nome = "Renato de Oliveira"; */



/* //2° Forma
$resultado = $pdo->query("INSERT INTO pessoa(nome, telefone, email) VALUES('Renan Maia de Carvalho', '954816957', 'renan-contato@hotmail.com')"); */


//----------------------- DELETE -----------------------------

/* //1° Forma
$delete = $pdo->prepare("DELETE FROM pessoa WHERE id = :id");
$id = 4;
$delete->bindValue(":id",$id);
$delete->execute();
echo "ID deletado com sucesso." */


/* //2° Forma
$delete = $pdo->query("DELETE FROM pessoa WHERE id = '3'");
echo "Informações deletadas com sucesso!" */


//----------------------- UPDATE -----------------------------


/* $update = $pdo->prepare("UPDATE pessoa SET nome = :nome WHERE id = :id");
$update->bindValue(":nome", "Diego Marques");
$update->bindVALUE(":id",1);
$update->execute();
echo "Os dados foram atualizados com Sucesso!"; */



/* //2° Forma
$update = $pdo->query("UPDATE pessoa SET nome = 'Maria de Lourdes' WHERE id = '1'"); */


//----------------------- SELECT -----------------------------

//1° Forma
/* $select = $pdo->prepare("SELECT * FROM pessoa WHERE id = :id");
$select->bindValue(":id",1);
$select->execute();
$result = $select->fetch(PDO::FETCH_ASSOC);

echo "----------RESULTADO----------<br>";
foreach($result as $key => $value){
       echo strtoupper($key). ": ".strtoupper($value). "<br>";
}
//fetch();//Transformando os dados em um array. fetch() usado quando queremos retornar apenas 1 linha de código.
//fetchAll();//Para trazer mais de um registro no banco de dados. */
/* 
//2° Forma
$select = $pdo->query("SELECT * FROM pessoa WHERE id = '1'");
$result = $select->fetch(PDO::FETCH_ASSOC);

echo "----------RESULTADO----------<br>";
foreach($result as $key => $value){
       echo strtoupper($key). ": ".strtoupper($value). "<br>";
} */



?>