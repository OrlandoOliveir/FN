<?php

require_once __DIR__ . '/../config/db_connection.php';

class ProdutoRepository {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Retorna todos os produtos
    public function getAll() {
        $sql = "SELECT * FROM produtos";
        $stmt = $this->db->query($sql);

        $produtos = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            print_r($row);
        }
        return $produtos;
    }

    // Retorna um produto pelo ID
    public function getById($id) {
        $sql = "SELECT * FROM produtos WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Produto(
                $row['id'],
                $row['nome'],
                $row['valor_base'],
                $row['qtd']
            );
        }
        return null;
    }

    // Insere um novo produto
    public function insert($nome, $valor_base, $qtd) {
        $sql = "INSERT INTO produtos (nome, valor_base, qtd) 
                VALUES (:nome, :valor_base, :qtd)";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
        $stmt->bindParam(":valor_base", $valor_base, PDO::PARAM_STR);
        $stmt->bindParam(":qtd", $qtd, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "Produto cadastrado com sucesso!";
        } else {
            return "Erro ao cadastrar produto.";
        }
    }

    // Atualiza um produto existente
    public function update($id, $nome, $valor_base, $qtd) {
        $sql = "UPDATE produtos
                SET nome = :nome, 
                    valor_base = :valor_base, 
                    qtd = :qtd 
                WHERE id = :id";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
        $stmt->bindParam(":valor_base", $valor_base, PDO::PARAM_STR);
        $stmt->bindParam(":qtd", $qtd, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "Produto atualizado com sucesso!";
        } else {
            return "Erro ao atualizar produto.";
        }
    }

    // Deleta um produto pelo ID
    public function delete($id) {
        $sql = "DELETE FROM produtos WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "Produto deletado com sucesso!";
        } else {
            return "Erro ao deletar produto.";
        }
    }
}