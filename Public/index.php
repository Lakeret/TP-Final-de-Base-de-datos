<?php require_once 'header.php'; ?>
<style>
    /* Hero Section */
    .hero-section {
        background: linear-gradient(135deg, rgba(45, 80, 22, 0.9), rgba(74, 124, 44, 0.85)), 
                    url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 600"><defs><pattern id="pine" x="0" y="0" width="120" height="120" patternUnits="userSpaceOnUse"><path d="M60 10 L70 40 L50 40 Z M60 30 L75 70 L45 70 Z M60 60 L80 110 L40 110 Z" fill="rgba(255,255,255,0.05)"/></pattern></defs><rect width="1200" height="600" fill="url(%23pine)"/></svg>');
        background-size: cover;
        background-position: center;
        border-radius: 20px;
        padding: 4rem 2rem;
        margin-bottom: 3rem;
        text-align: center;
        box-shadow: 0 10px 40px rgba(45, 80, 22, 0.3);
    }
    
    .hero-title {
        font-family: 'Playfair Display', serif;
        font-size: 3.5rem;
        color: white;
        text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.4);
        margin-bottom: 1rem;
        animation: fadeInDown 1s;
    }
    
    .hero-subtitle {
        font-size: 1.3rem;
        color: rgba(255, 255, 255, 0.95);
        margin-bottom: 2rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        animation: fadeInUp 1s;
    }
    
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    /* Carousel Mejorado */
    .carousel {
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        margin-bottom: 3rem;
    }
    
    .carousel-item img {
        height: 500px;
        object-fit: cover;
        border-radius: 20px;
    }
    
    .carousel-caption {
        background: linear-gradient(to top, rgba(45, 80, 22, 0.9), rgba(45, 80, 22, 0.6));
        border-radius: 15px;
        padding: 1.5rem !important;
        bottom: 2rem;
        left: 2rem;
        right: 2rem;
    }
    
    .carousel-caption h5 {
        font-family: 'Playfair Display', serif;
        font-size: 2rem;
        color: white;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }
    
    .carousel-caption p {
        font-size: 1.1rem;
        color: rgba(255, 255, 255, 0.95);
    }
    
    /* Section Title */
    .section-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        color: var(--forest-green);
        text-align: center;
        margin-bottom: 2rem;
        position: relative;
        padding-bottom: 1rem;
    }
    
    .section-title::after {
        content: '🌲';
        position: absolute;
        left: 50%;
        bottom: 0;
        transform: translateX(-50%);
        font-size: 1.5rem;
    }
    
    /* Cards Mejoradas */
    .cabin-card {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.4s;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        background: white;
        height: 100%;
    }
    
    .cabin-card:hover {
        transform: translateY(-15px) scale(1.02);
        box-shadow: 0 20px 50px rgba(45, 80, 22, 0.3);
    }
    
    .cabin-card .card-img-top {
        height: 250px;
        object-fit: cover;
        transition: transform 0.4s;
    }
    
    .cabin-card:hover .card-img-top {
        transform: scale(1.15);
    }
    
    .cabin-card .card-body {
        padding: 1.5rem;
    }
    
    .cabin-card .card-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        color: var(--forest-green);
        margin-bottom: 1rem;
    }
    
    .cabin-card .card-text {
        color: #666;
        line-height: 1.6;
        min-height: 80px;
    }
    
    .cabin-card .card-footer {
        background: linear-gradient(135deg, #f5f1e8 0%, #e8ded0 100%);
        border-top: 2px solid var(--light-green);
        padding: 1.25rem;
    }
    
    .capacity-badge {
        background: var(--light-green);
        color: white;
        padding: 0.4rem 1rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.9rem;
    }
    
    .price-tag {
        font-family: 'Poppins', sans-serif;
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--wood-brown);
    }
    
    .btn-reserve {
        background: linear-gradient(135deg, var(--wood-brown), var(--light-brown));
        color: white;
        border: none;
        padding: 0.6rem 1.5rem;
        border-radius: 20px;
        font-weight: 600;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(139, 69, 19, 0.3);
    }
    
    .btn-reserve:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 25px rgba(139, 69, 19, 0.5);
        color: white;
    }
    
    /* Features Section */
    .features {
        background: linear-gradient(135deg, rgba(74, 124, 44, 0.1), rgba(45, 80, 22, 0.05));
        border-radius: 20px;
        padding: 3rem 2rem;
        margin: 3rem 0;
        text-align: center;
    }
    
    .feature-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
    }
    
    .feature-title {
        font-family: 'Playfair Display', serif;
        color: var(--forest-green);
        font-size: 1.3rem;
        margin-bottom: 0.5rem;
    }
</style>

<?php 
// Traer cabañas para el carousel y cards
$sql = ("SELECT id, nombre, descripcion, precio_noche, capacidad, imagen FROM cabanas ORDER BY created_at DESC");
$result = $link->query($sql);
$cabanas = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $cabanas[] = $row;
    }
}
?>

<!-- Hero Section -->
<div class="hero-section">
    <h1 class="hero-title">🏔️ Bienvenido a tu Refugio Natural</h1>
    <p class="hero-subtitle">Descubre la tranquilidad del bosque en nuestras acogedoras cabañas</p>
    <div>
        <?php if (!is_logged()): ?>
        <a href="register.php" class="btn btn-nature me-2">✨ Comienza tu Aventura</a>
        <?php endif; ?>
    </div>
</div>

<!-- Features -->
<div class="features mb-5">
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="feature-icon">🌲</div>
            <h3 class="feature-title">Naturaleza Pura</h3>
            <p>Rodeado de bosques y montañas</p>
        </div>
        <div class="col-md-4 mb-3">
            <div class="feature-icon">🔥</div>
            <h3 class="feature-title">Comodidad Total</h3>
            <p>Chimenea, jacuzzi y más</p>
        </div>
        <div class="col-md-4 mb-3">
            <div class="feature-icon">⭐</div>
            <h3 class="feature-title">Experiencia Única</h3>
            <p>Desconexión garantizada</p>
        </div>
    </div>
</div>

<?php if (!empty($cabanas)): ?>
<!-- Carousel -->
<div class="carousel slide mb-5" id="carouselCabanas" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <?php foreach ($cabanas as $i => $c): ?>
        <button type="button" data-bs-target="#carouselCabanas" data-bs-slide-to="<?php echo $i; ?>" <?php echo $i === 0 ? 'class="active"' : ''; ?>></button>
        <?php endforeach; ?>
    </div>
    <div class="carousel-inner">
        <?php foreach ($cabanas as $i => $c): 
            $imagen = !empty($c['imagen']) && file_exists($c['imagen']) ? $c['imagen'] : 'images/placeholder.php?w=1200&h=500&text=' . urlencode($c['nombre']);
        ?>
        <div class="carousel-item <?php echo $i === 0 ? 'active' : ''; ?>">
            <img src="<?php echo esc($imagen); ?>" class="d-block w-100" alt="<?php echo esc($c['nombre']); ?>">
            <div class="carousel-caption">
                <h5>🏡 <?php echo esc($c['nombre']); ?></h5>
                <p><?php echo esc(substr($c['descripcion'], 0, 150)); ?>...</p>
                <a href="reservar.php?id=<?php echo $c['id']; ?>" class="btn btn-wood">Reservar Ahora</a>
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

<!-- Cabañas Disponibles -->
<h2 class="section-title">Nuestras Cabañas</h2>
<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mb-5">
    <?php foreach ($cabanas as $c): 
        $card_imagen = !empty($c['imagen']) && file_exists($c['imagen']) ? $c['imagen'] : 'images/placeholder.php?w=400&h=250&text=' . urlencode($c['nombre']);
    ?>
    <div class="col">
        <div class="cabin-card">
            <div style="overflow:hidden;">
                <img src="<?php echo esc($card_imagen); ?>" class="card-img-top" alt="<?php echo esc($c['nombre']); ?>">
            </div>
            <div class="card-body">
                <h5 class="card-title">🏡 <?php echo esc($c['nombre']); ?></h5>
                <p class="card-text"><?php echo esc(substr($c['descripcion'], 0, 140)); ?><?php echo strlen($c['descripcion']) > 140 ? '...' : ''; ?></p>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="capacity-badge">👥 <?php echo esc($c['capacidad']); ?> personas</span>
                    <div class="text-end">
                        <div class="price-tag">$<?php echo number_format($c['precio_noche'], 0, ',', '.'); ?></div>
                        <small class="text-muted">por noche</small>
                    </div>
                </div>
                <a href="reservar.php?id=<?php echo $c['id']; ?>" class="btn btn-reserve w-100 mt-3">🎯 Reservar Ahora</a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php else: ?>
<div class="alert alert-info text-center">
    <h4>🏡 Próximamente nuevas cabañas</h4>
    <p>Estamos preparando experiencias increíbles para ti. ¡Vuelve pronto!</p>
</div>
<?php endif; ?>

<?php require_once 'footer.php'; ?>
