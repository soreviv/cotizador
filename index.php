<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Cotizador - Dr. Alejandro Viveros</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet" />
  <style>
    body { font-family: 'Open Sans', Arial, sans-serif; padding: 20px; background: #f4f6f9; color: #333; }
    .container { max-width: 800px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
    h1 { color: #1E5B8B; text-align: center; }
    label { font-weight: 600; color: #1E5B8B; }
    input, select { width: 100%; padding: 8px; margin: 5px 0 15px; border: 1px solid #ccc; border-radius: 4px; }
    button { background: #1E5B8B; color: white; padding: 12px 20px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; }
    button:hover { background: #164668; }
    .footer { margin-top: 30px; font-size: 12px; color: #666; text-align: center; }
  </style>
</head>
<body>
  <div class="container">
    <div style="text-align: right; margin-bottom: 15px;"><a href="logout.php" style="text-decoration: none; background: #F28C28; color: white; padding: 8px 15px; border-radius: 4px; font-size: 14px;">Cerrar Sesión</a></div>
    <h1>Cotización de Auxiliares Auditivos</h1>
    <form action="generar_php" method="post" target="_blank">
      <label>Nombre del Cliente:</label>
      <input type="text" name="cliente" required />

      <label>Teléfono:</label>
      <input type="text" name="telefono" />

      <label>Correo:</label>
      <input type="email" name="correo" />

      <label>Modelo del Auxiliar Auditivo:</label>
      <input type="text" name="modelo" required />

      <label>Marca:</label>
      <select name="marca" required>
        <option value="Widex">Widex</option>
        <option value="Starkey">Starkey</option>
        <option value="Otra">Otra</option>
      </select>

      <label>Tipo:</label>
      <select name="tipo" required>
        <option value="RIC">RIC</option>
        <option value="BTE">BTE</option>
        <option value="Hecho a la medida">Hecho a la medida</option>
      </select>

      <label>Alimentación:</label>
      <select name="alimentacion" required>
        <option value="Pilas">Pilas</option>
        <option value="Recargable">Recargable</option>
      </select>

      <label>Cargador (si aplica):</label>
      <select name="cargador">
        <option value="No">No</option>
        <option value="Sí">Sí (costo adicional)</option>
      </select>

      <label>Precio Unitario (MXN):</label>
      <input type="number" name="precio" step="0.01" required />

      <button type="submit">Generar PDF</button>
    </form>
    <div class="footer">
      Sistema de cotización - Dr. Alejandro Viveros Domínguez<br>
      RFC: VIDA851218DQ8 | www.otorrinonet.com
    </div>
  </div>
</body>
</html>