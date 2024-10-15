<?php
class CrudController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Create: Insert new record
    public function create($table, $data) {
        $fields = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));

        $query = "INSERT INTO $table ($fields) VALUES ($placeholders)";
        $stmt = $this->db->prepare($query);

        foreach ($data as $key => &$value) {
            $stmt->bindParam(":$key", $value);
        }

        if ($stmt->execute()) {
            return ["status" => true, "message" => "Record created successfully."];
        } else {
            return ["status" => false, "message" => "Failed to create record."];
        }
    }

    // Read: Fetch records (optionally by ID)
    public function read($table, $id = null) {
        $query = "SELECT * FROM $table";
        if ($id) {
            $query .= " WHERE id = :id LIMIT 1";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":id", $id);
        } else {
            $stmt = $this->db->prepare($query);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Update: Update record by ID
    public function update($table, $id, $data) {
        $updateFields = "";
        foreach ($data as $key => $value) {
            $updateFields .= "$key = :$key, ";
        }
        $updateFields = rtrim($updateFields, ", ");

        $query = "UPDATE $table SET $updateFields WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":id", $id);

        foreach ($data as $key => &$value) {
            $stmt->bindParam(":$key", $value);
        }

        if ($stmt->execute()) {
            return ["status" => true, "message" => "Record updated successfully."];
        } else {
            return ["status" => false, "message" => "Failed to update record."];
        }
    }

    // Delete: Remove record by ID
    public function delete($table, $id) {
        $query = "DELETE FROM $table WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            return ["status" => true, "message" => "Record deleted successfully."];
        } else {
            return ["status" => false, "message" => "Failed to delete record."];
        }
    }
}
?>
