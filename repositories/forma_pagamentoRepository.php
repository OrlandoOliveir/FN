<?php

require_once __DIR__ . '/../config/db_connection.php';

class FormaPagamentoRepository {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll() {
        $sql = "SELECT * FROM formas_pagamento";
        $stmt = $this->db->query($sql);

        $formasPagamento = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            print_r($row);
        }
        return $formasPagamento;
    }

    public function getById($id) {
        $sql = "SELECT * FROM formas_pagamento WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new FormaPagamento(
                $row['id'],
                $row['desc'],
                $row['qtd'],
                $row['tipo']
            );
        }
        return null;
    }

    public function insert($desc, $qtd, $tipo) {
        $sql = "INSERT INTO formas_pagamento (desc, qtd, tipo) 
                VALUES (:desc, :qtd, :tipo)";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":desc", $desc, PDO::PARAM_STR);
        $stmt->bindParam(":qtd", $qtd, PDO::PARAM_INT);
        $stmt->bindParam(":tipo", $tipo, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "Forma de pagamento cadastrada com sucesso!";
        } else {
            return "Erro ao cadastrar forma de pagamento.";
        }
    }

    public function update($id, $desc, $qtd, $tipo) {
        $sql = "UPDATE formas_pagamento
                SET desc = :desc, 
                    qtd = :qtd, 
                    tipo = :tipo 
                WHERE id = :id";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":desc", $desc, PDO::PARAM_STR);
        $stmt->bindParam(":qtd", $qtd, PDO::PARAM_INT);
        $stmt->bindParam(":tipo", $tipo, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "Forma de pagamento atualizada com sucesso!";
        } else {
            return "Erro ao atualizar forma de pagamento.";
        }
    }
    public function delete($id) {
        $sql = "DELETE FROM formas_pagamento WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "Forma de pagamento deletada com sucesso!";
        } else {
            return "Erro ao deletar forma de pagamento.";
        }
    }
}