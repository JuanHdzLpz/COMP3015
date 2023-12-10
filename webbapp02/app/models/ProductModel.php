<?php


//include_once 'app/models/ProductController.php';
include_once 'app/config/Database.php';
class ProductModel {
private $productModel;
public function __construct() {
$database = new Database();
$db = $database->connect();
$this->productModel = new ProductModel($db);
}
public function index() {
$data = $this->listProducts();
include 'app/views/home.php';
}
public function create() {
    $sql = "INSERT INTO producto (nombre, suplidor, cantidad, precio)
    VALUES (:nombre, :suplidor, :cantidad, :precio)";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':nombre', $data['nombre'], PDO::PARAM_STR);
    $stmt->bindValue(':suplidor', $data[suplidor], PDO::PARAM_STR);
    $stmt->bindValue(':cantidad', $data['cantidad'], PDO::PARAM_STR);
    $stmt->bindValue(':precio', $data['precio'], PDO::PARAM_STR);
$data['view'] = 'app/views/product/create.php';
include 'app/views/home.php';
}
public function read($id) {
    $sql = "SELECT * FROM producto WHERE id = :id";
$product = $this->productModel->read($id);

if ($product) {
include 'app/views/product/read.php';
// Cargar una vista para mostrar los datos del usuario
} else {
echo 'Error reading a record.';
// Mostrar un mensaje de error o redirigir
}
}
public function update($id) {
    $sql = "UPDATE producto SET nombre = :nombre, suplidor = 
    :suplidor, cantidad = :cantidad, precio = :precio WHERE id = :id";
$stmt = $this->db->prepare($sql);
$stmt->bindValue(':nombre', $data['nombre'], PDO::PARAM_STR);
$stmt->bindValue(':suplidor', $data['suplidor'], PDO::PARAM_STR);
$stmt->bindValue(':cantidad', $data['cantidad'], PDO::PARAM_STR);
$stmt->bindValue(':precio', $data['precio'], PDO::PARAM_STR);
$data['product'] = $this->productModel->read($id);
$data['view'] = 'app/views/product/update.php';
include 'app/views/home.php';
}
public function save($data) {
$new_data = [
'id' => $data['id'],
'nombre' => $data['nombre'],
'suplidor' => $data['suplidor'],
'cantidad' => $data['cantidad'],
'precio' => $data['precio']
];
if ($data['id'] == 0)
$result = $this->productModel->create($new_data);
else
$result = $this->productModel->update($new_data);
if ($result) {
if ($data['id'] == 0)
// Se pudo añadir con éxito
$data['message'] = 'Récord añadido con
éxito.';

else
// Se pudo actualizar, mensaje de éxito
$data['message'] = 'Récord actualizado con
éxito.';
} else {
// No se pudo actualizar, mensaje de error
$data['message'] = 'Récord NO pudo ser
actualizado.';
}
$data['view'] = 'app/views/product/list.php';
$data['products'] = $this->productModel->getAll();
include 'app/views/home.php';
}
public function delete($id) {
    $sql = "DELETE FROM producto WHERE id = :id";

$data['product'] = $this->productModel->read($id);
$data['view'] = 'app/views/product/delete.php';
include 'app/views/home.php';
}
public function remove($id)
{
    
$result = $this->productModel->delete($id);
if ($result) {
// Redirigir o mostrar un mensaje de éxito
} else {
// Mostrar un mensaje de error
}
$this->index();
}
public function listProducts() {
    $sql = "SELECT * FROM producto";

$data['products'] = $this->productModel->getAll();
$data['view'] = 'product/list.php';
return $data;
}
}
?>