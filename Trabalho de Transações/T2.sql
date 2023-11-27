-- LEITURA FANTASMA
BEGIN;
INSERT INTO ordens_servico(numero, data, valor_total, status, codfunc, codcliente) VALUES (145, '2023-11-24', 100.00, 'a', 200, 101);
COMMIT;

--LEITURA NÃO REPETITIVA
BEGIN;
UPDATE funcionarios set endereco = 'General Osorio' where codfunc = 200;
COMMIT;

-- DEADLOCK
BEGIN;
UPDATE funcionarios SET nome = 'Fulano' WHERE codfunc = 200;
--inicia T1
UPDATE ordens_servico SET status = 'f' WHERE codfunc = 200;
COMMIT;