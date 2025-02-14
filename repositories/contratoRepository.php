<?php 

require_once __DIR__ . '/../config/db_connection.php';


class ContratoRepository {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    public function getAll() {
        $sql = "SELECT * FROM contratos";
        $stmt = $this->db->query($sql);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            print_r($row);
        }
    }
    public function getById($id) {
        $sql = "SELECT * FROM contratos WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            print_r($row);
        }
    }

    public function update($id_contrato,$cliente_id,$forma_pagamento_id,$id_produto) {
        $sql="UPDATE contratos
        set cliente_id =:cliente_id, forma_pagamento_id =:forma_pagamento_id,id_produto =:id_produto WHERE id_contrato =:id_contrato";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id_contrato",$id_contrato,PDO::PARAM_INT);
        $stmt->bindParam(":cliente_id",$cliente_id,PDO::PARAM_INT);
        $stmt->bindParam(":forma_pagamento_id",$forma_pagamento_id,PDO::PARAM_INT);
        $stmt->bindParam(":id_produto",$id_produto,PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "Contrato atualizado com sucesso!";
        } else {
            echo "Erro ao atualizar Contrato.";
        }
    }

public function delete($id) {
    $sql = "DELETE FROM contratos WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "Contrato deletado com sucesso!";
    } else {
        echo "Erro ao deletar Contrato.";
    }
}

public function insert($cliente_id,$forma_pagamento_id,$id_produto) {
    $sql = "INSERT INTO contratos (cliente_id, forma_pagamento_id,$id_produto) 
            VALUES (:cliente_id,:forma_pagamento_id,:produto)";

    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(":cliente_id",$cliente_id, PDO::PARAM_INT);
    $stmt->bindParam(":forma_pagamento_id",$forma_pagamento_id, PDO::PARAM_INT);    
    $stmt->bindParam(":produto",$id_produto, PDO::PARAM_INT);

    if ($stmt->execute()) {
        return "Contrato cadastrado com sucesso!";
    } else {
        return "Erro ao cadastrar Contrato.";
    }
}

}
