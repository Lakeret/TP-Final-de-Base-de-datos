<?php
// index.php - Home con Carousel y Cards
require_once 'header.php';
global $mysqli;

// Traer cabañas para el carousel y cards
$stmt = $mysqli->prepare("SELECT id, nombre, descripcion, precio_noche, capacidad, imagen FROM cabanas ORDER BY created_at DESC");
$stmt->execute();
$res = $stmt->get_result();
$cabanas = $res->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<div class="row">
  <div class="col-12">
    <!-- Carousel -->
    <div id="carouselCabanas" class="carousel slide mb-4" data-bs-ride="carousel">
      <div class="carousel-inner">
        <?php foreach ($cabanas as $i => $c): ?>
        <div class="carousel-item <?php echo $i === 0 ? 'active' : ''; ?>">
          <img src="<?php echo esc($c['imagen'] ?: 'images/default.jpg'); ?>" class="d-block w-100" style="height:400px; object-fit:cover;" alt="<?php echo esc($c['nombre']); ?>">
          <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-2">
            <h5><?php echo esc($c['nombre']); ?></h5>
            <p><?php echo esc(substr($c['descripcion'],0,120)); ?>...</p>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselCabanas" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselCabanas" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
    </div>
  </div>
</div>

<!-- Cards -->
<div class="row row-cols-1 row-cols-md-3 g-4">
  <?php foreach ($cabanas as $c): ?>
  <div class="col">
    <div class="card h-100">
      <img src="<?php echo esc($c['imagen'] ?: 'images/default.jpg'); ?>" class="card-img-top" style="height:200px; object-fit:cover;" alt="...">
      <div class="card-body">
        <h5 class="card-title"><?php echo esc($c['nombre']); ?></h5>
        <p class="card-text"><?php echo esc(substr($c['descripcion'],0,140)); ?></p>
      </div>
      <div class="card-footer d-flex justify-content-between align-items-center">
        <small class="text-muted">Capacidad: <?php echo esc($c['capacidad']); ?></small>
        <div>
          <strong>$<?php echo number_format($c['precio_noche'],2,',','.'); ?> / noche</strong>
          <a href="reservar.php?id=<?php echo $c['id']; ?>" class="btn btn-sm btn-primary ms-2">Reservar</a>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
</div>

<?php require_once 'footer.php'; ?>