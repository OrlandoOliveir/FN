<?php 

require_once __DIR__ . '/../config/db_connection.php';


class ClienteRepository {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    public function getAll() {
        $sql = "SELECT * FROM clientes";
        $stmt = $this->db->query($sql);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            print_r($row);
        }
    }
    
    public function getById($id) {
        $sql = "SELECT * FROM clientes WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            print_r($row);
        }
    }

    public function update($id, $nome, $endereco, $numero, $cep, $telefone) {
        $sql = "UPDATE clientes 
                SET nome = :nome, endereco = :endereco, numero = :numero, 
                    cep = :cep, telefone = :telefone  
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
        $stmt->bindParam(":endereco", $endereco, PDO::PARAM_STR);
        $stmt->bindParam(":numero", $numero, PDO::PARAM_INT);
        $stmt->bindParam(":cep", $cep, PDO::PARAM_STR);
        $stmt->bindParam(":telefone", $telefone, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo "Cliente atualizado com sucesso!";
        } else {
            echo "Erro ao atualizar cliente.";
        }
    }

public function delete($id) {
    $sql = "DELETE FROM clientes WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "Cliente deletado com sucesso!";
    } else {
        echo "Erro ao deletar cliente.";
    }
}

public function insert($nome, $endereco, $numero, $cep, $telefone) {
    $sql = "INSERT INTO clientes (nome, endereco, numero, cep, telefone) 
            VALUES (:nome, :endereco, :numero, :cep, :telefone)";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
    $stmt->bindParam(":endereco", $endereco, PDO::PARAM_STR);
    $stmt->bindParam(":numero", $numero, PDO::PARAM_INT);
    $stmt->bindParam(":cep", $cep, PDO::PARAM_STR);
    $stmt->bindParam(":telefone", $telefone, PDO::PARAM_STR);

    if ($stmt->execute()) {
        return "Cliente cadastrado com sucesso!";
    } else {
        return "Erro ao cadastrar cliente.";
    }
}

}
