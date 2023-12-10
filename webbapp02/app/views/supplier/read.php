<?php
    $supplier = $data['supplier'];
?>
<?php if ($supplier): ?>
    <h1><?php echo $supplier['nombre']; ?></h1>
    <p>Email: <?php echo $supplier['email']; ?></p>
    <!-- Más detalles del usuario aquí -->
<?php else: ?>
    <p>Suplidor no encontrado.</p>
<?php endif; ?>