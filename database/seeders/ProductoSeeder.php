<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = Categoria::pluck('id', 'nombre');

        $productos = [
            [
                'nombre'       => 'Laptop Pro 15 pulgadas',
                'descripcion'  => 'Laptop con procesador de 8 núcleos, 16 GB RAM y SSD NVMe de 512 GB.',
                'categoria_id' => $categorias['Computación'],
                'precio'       => 18500.00,
                'existencias'  => 8,
                'estado'       => 'Disponible',
            ],
            [
                'nombre'       => 'Monitor IPS 27 pulgadas 144Hz',
                'descripcion'  => 'Monitor Full HD con panel IPS, bordes delgados y tiempo de respuesta de 1 ms.',
                'categoria_id' => $categorias['Computación'],
                'precio'       => 4299.00,
                'existencias'  => 14,
                'estado'       => 'Disponible',
            ],
            [
                'nombre'       => 'Mini PC Oficina Compacta',
                'descripcion'  => 'Computadora de escritorio ultracompacta ideal para punto de venta y oficina.',
                'categoria_id' => $categorias['Computación'],
                'precio'       => 6800.00,
                'existencias'  => 0,
                'estado'       => 'Agotado',
            ],
            [
                'nombre'       => 'Teclado Mecánico RGB Switch Rojo',
                'descripcion'  => 'Teclado mecánico compacto en español con retroiluminación personalizable.',
                'categoria_id' => $categorias['Periféricos'],
                'precio'       => 1150.50,
                'existencias'  => 22,
                'estado'       => 'Disponible',
            ],
            [
                'nombre'       => 'Mouse Inalámbrico Ergonómico',
                'descripcion'  => 'Mouse óptico recargable con sensor de 4000 DPI y receptor USB.',
                'categoria_id' => $categorias['Periféricos'],
                'precio'       => 549.00,
                'existencias'  => 35,
                'estado'       => 'Disponible',
            ],
            [
                'nombre'       => 'Alfombrilla XL Antideslizante',
                'descripcion'  => 'Tapete de escritorio de 80x30 cm con bordes cosidos de alta durabilidad.',
                'categoria_id' => $categorias['Periféricos'],
                'precio'       => 220.00,
                'existencias'  => 0,
                'estado'       => 'Agotado',
            ],
            [
                'nombre'       => 'Audífonos Diadema Cancelación de Ruido',
                'descripcion'  => 'Audífonos inalámbricos Bluetooth con batería de hasta 30 horas.',
                'categoria_id' => $categorias['Audio y Video'],
                'precio'       => 2390.00,
                'existencias'  => 11,
                'estado'       => 'Disponible',
            ],
            [
                'nombre'       => 'Micrófono Condensador USB',
                'descripcion'  => 'Micrófono cardioide para videollamadas, clases en línea y grabación de voz.',
                'categoria_id' => $categorias['Audio y Video'],
                'precio'       => 1299.00,
                'existencias'  => 6,
                'estado'       => 'Disponible',
            ],
            [
                'nombre'       => 'Cámara Web Full HD 1080p',
                'descripcion'  => 'Webcam con enfoque automático, tapa de privacidad y doble micrófono integrado.',
                'categoria_id' => $categorias['Audio y Video'],
                'precio'       => 890.00,
                'existencias'  => 0,
                'estado'       => 'Agotado',
            ],
            [
                'nombre'       => 'Bocinas Estéreo de Escritorio',
                'descripcion'  => 'Par de altavoces compactos alimentados por USB con control de volumen frontal.',
                'categoria_id' => $categorias['Audio y Video'],
                'precio'       => 430.00,
                'existencias'  => 19,
                'estado'       => 'Disponible',
            ],
            [
                'nombre'       => 'Router Wi-Fi 6 Doble Banda',
                'descripcion'  => 'Router inalámbrico AX1800 con 4 antenas externas y puertos Gigabit.',
                'categoria_id' => $categorias['Redes'],
                'precio'       => 1450.00,
                'existencias'  => 9,
                'estado'       => 'Disponible',
            ],
            [
                'nombre'       => 'Switch Gigabit 8 Puertos',
                'descripcion'  => 'Switch de red metálico no administrable plug-and-play de alta velocidad.',
                'categoria_id' => $categorias['Redes'],
                'precio'       => 620.00,
                'existencias'  => 15,
                'estado'       => 'Disponible',
            ],
            [
                'nombre'       => 'Cable Ethernet Cat 6 (15 metros)',
                'descripcion'  => 'Cable de red UTP Cat 6 con conectores RJ45 reforzados.',
                'categoria_id' => $categorias['Redes'],
                'precio'       => 185.00,
                'existencias'  => 40,
                'estado'       => 'Disponible',
            ],
            [
                'nombre'       => 'Adaptador USB Wi-Fi AC1300',
                'descripcion'  => 'Antena receptora inalámbrica USB 3.0 de doble banda 2.4 GHz y 5 GHz.',
                'categoria_id' => $categorias['Redes'],
                'precio'       => 380.00,
                'existencias'  => 0,
                'estado'       => 'Agotado',
            ],
            [
                'nombre'       => 'SSD NVMe M.2 1 TB',
                'descripcion'  => 'Unidad de estado sólido PCIe Gen4 con lectura de hasta 5000 MB/s.',
                'categoria_id' => $categorias['Almacenamiento'],
                'precio'       => 1390.00,
                'existencias'  => 17,
                'estado'       => 'Disponible',
            ],
            [
                'nombre'       => 'Disco Duro Externo Portátil 2 TB',
                'descripcion'  => 'Almacenamiento externo USB 3.2 compatible con Windows, Linux y macOS.',
                'categoria_id' => $categorias['Almacenamiento'],
                'precio'       => 1520.00,
                'existencias'  => 12,
                'estado'       => 'Disponible',
            ],
            [
                'nombre'       => 'Memoria USB 3.2 de 128 GB',
                'descripcion'  => 'Unidad flash metálica compacta resistente a salpicaduras.',
                'categoria_id' => $categorias['Almacenamiento'],
                'precio'       => 240.00,
                'existencias'  => 50,
                'estado'       => 'Disponible',
            ],
            [
                'nombre'       => 'Tarjeta MicroSDXC 256 GB Clase 10',
                'descripcion'  => 'Tarjeta de memoria de alta velocidad con adaptador SD incluido.',
                'categoria_id' => $categorias['Almacenamiento'],
                'precio'       => 495.00,
                'existencias'  => 0,
                'estado'       => 'Agotado',
            ],
        ];

        foreach ($productos as $producto) {
            Producto::updateOrCreate(
                ['nombre' => $producto['nombre']],
                $producto
            );
        }
    }
}