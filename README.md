# Invoice API Documentation 📄💻

This project provides a simple API for managing invoices. Below are the available endpoints for creating, reading, updating, and deleting invoices. Each request is designed to be easy to use for integrating with various invoicing systems.

## 🛠️ API Endpoints

### 1. Create an Invoice 🧾

**Endpoint:**

```
POST /api.php?entity=invoices
```

**Request Body (JSON):**

```json
{
  "client_name": "John Doe",
  "amount": 150.0,
  "due_date": "2024-10-20"
}
```

**Description:**  
Creates a new invoice with the specified `client_name`, `amount`, and `due_date`.

---

### 2. Read All Invoices 📋

**Endpoint:**

```
GET /api.php?entity=invoices
```

**Description:**  
Fetches all invoices from the system. This endpoint returns a list of all created invoices in JSON format.

---

### 3. Update an Invoice ✏️

**Endpoint:**

```
PUT /api.php?entity=invoices&id=1
```

**Request Body (JSON):**

```json
{
  "amount": 200.0
}
```

**Description:**  
Updates an existing invoice by modifying the `amount`. Replace `id=1` with the ID of the invoice you want to update.

---

### 4. Delete an Invoice 🗑️

**Endpoint:**

```
DELETE /api.php?entity=invoices&id=1
```

**Description:**  
Deletes an invoice by ID. Replace `id=1` with the actual invoice ID you want to remove.

---

## ⚙️ Setup

1. Clone the repository:

   ```bash
   git clone https://github.com/digitalterrene/invoice-api.git
   ```

2. Install dependencies (if any).

3. Run the server:
   ```bash
   php -S localhost:8000
   ```

## 💬 Feedback and Contributions

Feel free to open issues or submit pull requests for any features or bug fixes. Contributions are welcome! 😊

---

Made with ❤️ by Digital Terrene
