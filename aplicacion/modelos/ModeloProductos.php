<?php

class ModeloProductos
{
    private PDO $bd;

    public function __construct(PDO $bd)
    {
        $this->bd = $bd;
    }


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

    public function obtenerTodos(): array
    {
        return $this->bd->query(
            'SELECT id, nombre, descripcion, precio, imagen, disponible
               FROM productos
              ORDER BY disponible DESC, id ASC'
        )->fetchAll();
    }

    public function obtenerPrecioMinimo(): ?float
    {
        $valor = $this->bd->query('SELECT MIN(precio) FROM productos WHERE disponible = 1')->fetchColumn();
        return ($valor === false || $valor === null) ? null : (float) $valor;
    }
}
