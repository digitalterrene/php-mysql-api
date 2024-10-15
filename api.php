<?php
// Load dependencies
require_once 'db.php';
require_once 'CrudController.php';

// Initialize the database connection
$database = new Database();
$db = $database->getConnection();

// Initialize the CRUD controller
$crud = new CrudController($db);

// Handle incoming requests (CRUD operations based on URL parameters)
$requestMethod = $_SERVER['REQUEST_METHOD'];
$entityType = $_GET['entity'] ?? null; // e.g., "invoices", "leads"
$id = $_GET['id'] ?? null;

if (!$entityType) {
    echo json_encode(["status" => false, "message" => "No entity type provided."]);
    exit();
}

// Get the request body (for POST/PUT)
$inputData = json_decode(file_get_contents("php://input"), true);

// Handle different HTTP methods
switch ($requestMethod) {
    case 'POST': // Create
        $result = $crud->create($entityType, $inputData);
        echo json_encode($result);
        break;
    
    case 'GET': // Read
        $result = $crud->read($entityType, $id);
        echo json_encode($result);
        break;
    
    case 'PUT': // Update
        if ($id) {
            $result = $crud->update($entityType, $id, $inputData);
            echo json_encode($result);
        } else {
            echo json_encode(["status" => false, "message" => "ID is required for update."]);
        }
        break;

    case 'DELETE': // Delete
        if ($id) {
            $result = $crud->delete($entityType, $id);
            echo json_encode($result);
        } else {
            echo json_encode(["status" => false, "message" => "ID is required for deletion."]);
        }
        break;

    default:
        echo json_encode(["status" => false, "message" => "Unsupported request method."]);
        break;
}
?>
