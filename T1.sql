-- SAVEPOINT | ROLLBACK TO
BEGIN;
INSERT INTO funcionarios (codfunc, nome, endereco, cpf, tipo) VALUES (120, 'Fulano', 'Rua das Jujubas, 442', '12144474982', 3);
SAVEPOINT sp1;
SELECT * FROM ordens_servico;
INSERT INTO ordens_servico (numero, data, valor_total, status, codfunc, codcliente) VALUES (1, '2023-11-24', 100.00, 'a', 120, 105);
ROLLBACK TO SAVEPOINT sp1;
COMMIT;
SELECT * FROM ordens_servico;

-- LEITURA FANTASMA
BEGIN;
SELECT * FROM ordens_servico WHERE status = 'a';
--inicia T2
SELECT * FROM ordens_servico WHERE  status = 'a';
COMMIT;

-- LEITURA NÃO REPETITIVA
BEGIN;
SELECT * FROM funcionarios WHERE codfunc = 200;
--inicia T2
SELECT * FROM funcionarios WHERE codfunc = 200;
COMMIT;

-- DEADLOCK
BEGIN;
UPDATE ordens_servico SET status = 'f' WHERE codfunc = 200;
--inicia T2
UPDATE funcionarios SET nome = 'Ciclano' WHERE codfunc = 200;
COMMIT;

SELECT * FROM ordens_servico WHERE codfunc = 200;
SELECT * FROM funcionarios WHERE codfunc = 200;