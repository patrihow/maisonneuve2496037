USE maisonneuve2496037;

SELECT * FROM cities;
SELECT * FROM students;

UPDATE cities
SET name = 'Bogota'
WHERE name = 'City 1';

UPDATE cities
SET name = CASE id
    WHEN 2 THEN 'Medellín'
    WHEN 3 THEN 'Cali'
    WHEN 4 THEN 'Barranquilla'
    WHEN 5 THEN 'Cartagena'
    WHEN 6 THEN 'Cúcuta'
    WHEN 7 THEN 'Pereira'
    WHEN 8 THEN 'Santa Marta'
    WHEN 9 THEN 'Bucaramanga'
    WHEN 10 THEN 'Manizales'
    WHEN 11 THEN 'Valledupar'
    WHEN 12 THEN 'Pasto'
    WHEN 13 THEN 'Neiva'
    WHEN 14 THEN 'Armenia'
    WHEN 15 THEN 'Ibagué'
    END
WHERE id BETWEEN 2 AND 15;