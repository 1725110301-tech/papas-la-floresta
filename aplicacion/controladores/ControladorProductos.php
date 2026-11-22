<?php
/**
 * Controlador de productos: pide los datos al modelo y los deja listos
 * para que la vista solo tenga que mostrarlos.
 */
class ControladorProductos
{
    private ModeloProductos $modelo;

    public function __construct(PDO $bd)
    {
        $this->modelo = new ModeloProductos($bd);
    }

    /** Datos que necesita la portada. */
    public function datosInicio(): array
    {
        try {
            return [
                'destacados'  => $this->modelo->obtenerDestacados(3),
                'precioDesde' => $this->modelo->obtenerPrecioMinimo(),
            ];
        } catch (PDOException $e) {
            // Si las tablas aún no existen, la portada igual carga.
            error_log('Error al leer productos: ' . $e->getMessage());
            return ['destacados' => [], 'precioDesde' => null];
        }
    }
}
