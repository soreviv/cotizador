<?php
session_start();
$error = '';
$password = 'admin'; // Puedes cambiar esta contraseña

if (isset($_POST['password'])) {
    if ($_POST['password'] == $password) {
        $_SESSION['loggedin'] = true;
        header('Location: index.php');
        exit;
    } else {
        $error = 'Contraseña incorrecta';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Acceso - Cotizador</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet" />
  <style>
    body { font-family: 'Open Sans', Arial, sans-serif; padding: 20px; background: #f4f6f9; color: #333; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
    .container { max-width: 400px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); text-align: center; }
    h1 { color: #1E5B8B; }
    label { font-weight: 600; color: #1E5B8B; }
    input { width: 100%; padding: 8px; margin: 10px 0 20px; border: 1px solid #ccc; border-radius: 4px; }
    button { background: #1E5B8B; color: white; padding: 12px 20px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; width: 100%; }
    button:hover { background: #164668; }
    .error { color: #D8000C; background-color: #FFD2D2; padding: 10px; border-radius: 4px; margin-bottom: 15px; }
  </style>
</head>
<body>
  <div class="container">
    <h1>Acceso al Cotizador</h1>
    <?php if ($error): ?>
      <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>
    <form method="post">
      <label for="password">Contraseña:</label>
      <input type="password" id="password" name="password" required />
      <button type="submit">Entrar</button>
    </form>
  </div>
</body>
</html>
