-- ============================================================
-- Datos iniciales. Importar DESPUÉS de estructura.sql
-- ============================================================

USE papas_floresta;

INSERT INTO productos (nombre, descripcion, precio, imagen, disponible) VALUES
('Papas a la francesa', 'Papas doradas y crujientes, recién hechas. Acompáñalas con tus aderezos favoritos.', 40.00, 'papas-a-la-francesa.jpg', 1),
('Plátanos fritos', 'Plátano macho frito, dulce y dorado por fuera, suave por dentro.', 35.00, 'platanos-fritos.jpg', 1),
('Banderillas', 'Salchicha empanizada en una crujiente cubierta dorada, en palito.', 30.00, 'banderillas.jpg', 1),
('Nachos', 'Totopos crujientes con queso y los toppings de la casa.', 45.00, 'nachos.jpg', 1),
('Papas estilo chips en vasito', 'Papas en rodajas finas y crujientes, listas para llevar en vasito.', 25.00, 'papas-chips-vasito.jpg', 1);

-- Administrador inicial
--   usuario:    admin
--   contraseña: Floresta2026!
-- CÁMBIALA en cuanto entres al panel (o genera otro hash con password_hash()).
INSERT INTO administradores (usuario, password) VALUES
('admin', '$2y$10$XkeYhqIbFUH53rdfIB8LfuvcGidxTtsoLAtFn2wMZEtltfzSzQPiS');
