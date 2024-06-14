<nav class="navbar navbar-expand-sm bg-primary" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Taktag</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
    data-bs-target="#navbarColor01" aria-controls="navbarColor01" 
    aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" 
          data-bs-toggle="dropdown" href="#" role="button" 
          aria-haspopup="true" aria-expanded="false">Inventario</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="inventario.php?alm=all">Inventario general</a>
            <?php
              $result=qry('SELECT id,nombre FROM almacenes WHERE favorito="S"');
              if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                      echo "<a class='dropdown-item' href='inventario.php?alm=" 
                      . $row['id'] . "'>". $row['nombre'] . "</a>";
                  }
              }
            ?>
            <div class="dropdown-divider"></div>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" 
          data-bs-toggle="dropdown" href="#" role="button" 
          aria-haspopup="true" aria-expanded="false">Consultar</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="almacenes.php">Almacenes</a>
            <a class="dropdown-item" href="movimientos.php">Movimientos</a>
            <a class="dropdown-item" href="clasificaciones.php">Clasificaciones</a>
          </div>
        </li>
      </ul>

      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
            <a class="nav-link" href="login.php"><i class="fas fa-user"></i> Pepe</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
