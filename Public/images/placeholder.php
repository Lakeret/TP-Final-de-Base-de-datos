<?php
// Generador de imágenes placeholder temáticas de cabañas
$width = isset($_GET['w']) ? (int)$_GET['w'] : 800;
$height = isset($_GET['h']) ? (int)$_GET['h'] : 600;
$text = isset($_GET['text']) ? $_GET['text'] : 'Cabaña del Bosque';

// Crear imagen
$image = imagecreatetruecolor($width, $height);

// Colores temáticos de bosque
$forest_green = imagecolorallocate($image, 45, 80, 22);
$light_green = imagecolorallocate($image, 74, 124, 44);
$wood_brown = imagecolorallocate($image, 139, 69, 19);
$light_brown = imagecolorallocate($image, 160, 130, 109);
$cream = imagecolorallocate($image, 245, 241, 232);
$white = imagecolorallocate($image, 255, 255, 255);

// Gradiente de fondo (cielo a bosque)
for ($i = 0; $i < $height; $i++) {
    $ratio = $i / $height;
    $r = (int)(74 + ($ratio * (45 - 74)));
    $g = (int)(124 + ($ratio * (80 - 124)));
    $b = (int)(44 + ($ratio * (22 - 44)));
    $color = imagecolorallocate($image, $r, $g, $b);
    imageline($image, 0, $i, $width, $i, $color);
}

// Dibujar "montañas" en el fondo
$mountain1 = array(
    0, $height * 0.6,
    $width * 0.3, $height * 0.3,
    $width * 0.6, $height * 0.6
);
$mountain2 = array(
    $width * 0.4, $height * 0.6,
    $width * 0.7, $height * 0.25,
    $width, $height * 0.6
);
imagefilledpolygon($image, $mountain1, 3, $forest_green);
imagefilledpolygon($image, $mountain2, 3, $forest_green);

// Dibujar "cabaña" simple en el centro
$cabin_x = $width / 2 - 40;
$cabin_y = $height / 2;
$cabin_width = 80;
$cabin_height = 50;

// Base de la cabaña
imagefilledrectangle($image, $cabin_x, $cabin_y, $cabin_x + $cabin_width, $cabin_y + $cabin_height, $wood_brown);

// Techo
$roof = array(
    $cabin_x - 10, $cabin_y,
    $cabin_x + $cabin_width / 2, $cabin_y - 30,
    $cabin_x + $cabin_width + 10, $cabin_y
);
imagefilledpolygon($image, $roof, 3, $light_brown);

// Puerta
imagefilledrectangle($image, $cabin_x + 30, $cabin_y + 20, $cabin_x + 50, $cabin_y + $cabin_height, $forest_green);

// Ventana
imagefilledrectangle($image, $cabin_x + 10, $cabin_y + 15, $cabin_x + 25, $cabin_y + 30, $cream);

// Texto principal
$font_size = 5;
$text_width = imagefontwidth($font_size) * strlen($text);
$x = ($width - $text_width) / 2;
$y = $height - 60;

// Sombra del texto
imagestring($image, $font_size, $x + 2, $y + 2, $text, $forest_green);
// Texto
imagestring($image, $font_size, $x, $y, $text, $white);

// Icono y subtexto
$subtitle = "🏡 " . $width . "x" . $height;
$sub_width = imagefontwidth(3) * strlen($subtitle);
imagestring($image, 3, ($width - $sub_width) / 2, $y + 25, $subtitle, $cream);

// Output
header('Content-Type: image/png');
header('Cache-Control: max-age=86400'); // Cache por 1 día
imagepng($image);
imagedestroy($image);
?>
