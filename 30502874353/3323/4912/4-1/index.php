<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Explorador de Archivos - Empresa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    body {
      background-color: #2c2f38;
      color: #e4e7eb;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .container {
      margin-top: 30px;
    }
    .header {
      text-align: center;
      padding-bottom: 30px;
    }
    .header img {
      max-width: 400px; /* Reducción del tamaño del logo */
    }
    .directory-list {
      margin-left: 20px;
      padding-left: 0;
      list-style-type: none;
    }
    .directory-item {
      background-color: #3a3f47;
      border-radius: 5px;
      margin: 10px 0;
      padding: 10px;
      cursor: pointer;
      color: #e4e7eb;
      font-weight: 500;
      box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
    }
    .directory-item:hover {
      background-color: #4b525d;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .directory-item i {
      margin-right: 10px;
    }
    .file-item {
      padding-left: 20px;
      font-size: 0.8rem;
      color: #b4bac2;
    }
    .file-item a {
      color: #adb5bd; /* Gris suave para los enlaces */
      text-decoration: none;
      display: inline-block;
      margin-right: 10px;
    }
    .file-item a:hover {
      text-decoration: underline;
      color: #ced4da; /* Gris más claro en hover */
    }
    .directory-item ul {
      display: none;
      margin-left: 20px;
    }
    .directory-item.open > ul {
      display: block;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <img src="https://qr.electroluzftp.com.ar/logo/logo6.png" class="img-fluid mb-3" alt="Logo">
      <h1 class="display-5">Explorador de Archivos</h1>
      <p class="lead">Accede a documentos, imágenes y archivos organizados por categoría.</p>
    </div>
    <ul class="directory-list">
      <?php
        // Lista de directorios
        $directories = array_filter(glob('*'), 'is_dir');
        foreach ($directories as $dir) {
          echo "<li class='directory-item'>
                  <i class='fas fa-folder'></i><span class='folder-toggle'>$dir/</span>
                  <ul>";
          
          // Lista de archivos dentro de cada directorio
          $files = glob($dir . '/*');
          foreach ($files as $file) {
            if (is_file($file)) {
              $fileExt = pathinfo($file, PATHINFO_EXTENSION);
              echo "<li class='file-item'>";
              
              // Verifica el tipo de archivo y muestra el icono adecuado
              if (in_array($fileExt, ['jpg', 'jpeg', 'png', 'gif', 'bmp'])) {
                echo "<i class='fas fa-image'></i><a href='$file' target='_blank'>$file</a>";
              } elseif ($fileExt == 'pdf') {
                echo "<i class='fas fa-file-pdf'></i><a href='$file' target='_blank'>$file</a>";
              } else {
                echo "<i class='fas fa-file'></i><a href='$file' target='_blank'>$file</a>";
              }
              echo "</li>";
            }
          }
          echo "</ul></li>";
        }
      ?>
    </ul>
  </div>

  <script>
    $(document).ready(function() {
      // Hacer clic en la carpeta para expandir o contraer
      $('.folder-toggle').on('click', function() {
        $(this).parent().toggleClass('open');
      });
    });
  </script>
</body>
</html>
