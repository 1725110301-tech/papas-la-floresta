<?php
/**
 * Modelo de productos: todo el acceso a la tabla `productos`.
 * Solo consultas preparadas; aquí no hay HTML.
 */
class ModeloProductos
{
    private PDO $bd;

    public function __construct(PDO $bd)
    {
        $this->bd = $bd;
    }

    /** Productos para la portada (primero los disponibles). */
    public function obtenerDestacados(int $limite = 3): array
    {
        $consulta = $this->bd->prepare(
            'SELECT id, nombre, descripcion, precio, imagen, disponible
               FROM productos
              ORDER BY disponible DESC, id ASC
              LIMIT :limite'
        );
        $consulta->bindValue(':limite', $limite, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    /** Todos los productos (lo usará la página de menú). */
    public function obtenerTodos(): array
    {
        return $this->bd->query(
            'SELECT id, nombre, descripcion, precio, imagen, disponible
               FROM productos
              ORDER BY disponible DESC, id ASC'
        )->fetchAll();
    }

    /** Precio más bajo entre los productos disponibles (null si no hay). */
    public function obtenerPrecioMinimo(): ?float
    {
        $valor = $this->bd->query('SELECT MIN(precio) FROM productos WHERE disponible = 1')->fetchColumn();
        return ($valor === false || $valor === null) ? null : (float) $valor;
    }
}
