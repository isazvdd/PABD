CREATE TABLE funcionario (
  codigo INT AUTO_INCREMENT,
  nome VARCHAR(15) NOT NULL,
  sexo CHAR(1) DEFAULT NULL,
  dataNasc DATE DEFAULT NULL,
  salario DECIMAL(10,2) DEFAULT NULL,
  supervisor INT,
  depto INT,
  PRIMARY KEY (codigo),
  CONSTRAINT funcSuperFK FOREIGN KEY (supervisor) REFERENCES funcionario(codigo) ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE departamento (
  codigo INT AUTO_INCREMENT,
  sigla VARCHAR(15) NOT NULL UNIQUE,
  descricao VARCHAR(25) NOT NULL,
  gerente INT,
  PRIMARY KEY (codigo),
  CONSTRAINT depGerenteFK FOREIGN KEY (gerente) REFERENCES funcionario(codigo) ON DELETE SET NULL ON UPDATE CASCADE
);

ALTER TABLE funcionario ADD CONSTRAINT funcDeptoFK FOREIGN KEY (depto) REFERENCES departamento(codigo) ON DELETE SET NULL ON UPDATE CASCADE;

CREATE TABLE equipe (
  codigo INT AUTO_INCREMENT,
  nomeEquipe VARCHAR(45) DEFAULT NULL,
  PRIMARY KEY (codigo)
);

CREATE TABLE membro (
  codigo INT AUTO_INCREMENT,
  codEquipe INT,
  codFuncionario INT,
  PRIMARY KEY (codigo),
  FOREIGN KEY (codEquipe) REFERENCES equipe(codigo) ON DELETE SET NULL,
  FOREIGN KEY (codFuncionario) REFERENCES funcionario(codigo) ON DELETE SET NULL
);

CREATE TABLE projeto (
  codigo INT AUTO_INCREMENT,
  descricao VARCHAR(45) DEFAULT NULL,
  depto INT,
  responsavel INT,
  dataInicio DATE DEFAULT NULL,
  dataFim DATE DEFAULT NULL,
  situacao VARCHAR(45) DEFAULT NULL,
  dataConclusao DATE DEFAULT NULL,
  equipe INT,
  PRIMARY KEY (codigo),
  FOREIGN KEY (depto) REFERENCES departamento(codigo) ON DELETE SET NULL,
  FOREIGN KEY (responsavel) REFERENCES funcionario(codigo) ON DELETE SET NULL,
  FOREIGN KEY (equipe) REFERENCES equipe(codigo) ON DELETE SET NULL
);

CREATE TABLE atividade (
  codigo INT AUTO_INCREMENT,
  descricao VARCHAR(45) DEFAULT NULL,
  dataInicio DATE DEFAULT NULL,
  dataFim DATE DEFAULT NULL,
  situacao VARCHAR(45) DEFAULT NULL,
  dataConclusao DATE DEFAULT NULL,
  PRIMARY KEY (codigo)
);

CREATE TABLE atividade_projeto (
  codAtividade INT,
  codProjeto INT,
  PRIMARY KEY (codProjeto, codAtividade),
  FOREIGN KEY (codAtividade) REFERENCES atividade(codigo),
  FOREIGN KEY (codProjeto) REFERENCES projeto(codigo)
);

CREATE TABLE atividade_membro (
  codAtividade INT,
  codMembro INT,
  PRIMARY KEY (codAtividade, codMembro),
  FOREIGN KEY (codAtividade) REFERENCES atividade(codigo),
  FOREIGN KEY (codMembro) REFERENCES membro(codigo)
);

INSERT INTO departamento
(sigla, descricao, gerente)
values ('DHC', 'Dep História', null);

INSERT INTO departamento
(sigla, descricao, gerente)
values ('DCT', 'Dep Computação', null);

INSERT INTO funcionario
(nome, sexo, dataNasc, salario, supervisor, depto)
values ('Ana', 'F', '1988-05-07', 2500.00, null, 1);

INSERT INTO funcionario
(nome, sexo, dataNasc, salario, supervisor, depto)
values ('Taciano', 'M', '1980-01-25', 2500.00, null, 2);

update departamento set gerente = 1 where sigla = 'DHC';
update departamento set gerente = 2 where sigla = 'DCT';

INSERT INTO funcionario
(nome, sexo, dataNasc, salario, supervisor, depto)
values ('Maria', 'F', '1981-07-01', 2500.00, 1, 1);

INSERT INTO funcionario
(nome, sexo, dataNasc, salario, supervisor, depto)
values ('Josefa', 'F', '1986-09-17', 2500.00, 1, 1);

INSERT INTO funcionario
(nome, sexo, dataNasc, salario, supervisor, depto)
values ('Carlos', 'M', '1985-11-21', 2500.00, 1, 1);

INSERT INTO funcionario
(nome, sexo, dataNasc, salario, supervisor, depto)
values ('Humberto', 'M', '1970-05-07', 1500.00, 2, 2);

INSERT INTO funcionario
(nome, sexo, dataNasc, salario, supervisor, depto)
values ('José', 'M', '1979-07-12', 3500.00, 2, 2);

INSERT INTO funcionario
(nome, sexo, dataNasc, salario, supervisor, depto)
values ('Xuxa', 'F', '1970-03-28', 13500.00, null, null);

INSERT INTO funcionario
(nome, sexo, dataNasc, salario, supervisor, depto)
values ('Sasha', 'F', '1970-03-28', 1500.00, 2, 1);

INSERT INTO funcionario
(nome, sexo, dataNasc, salario, supervisor, depto)
values ('Victor', 'M', '1970-03-28', 500.00, 4, 1);

INSERT INTO equipe
(nomeEquipe)
values ('BSI');

INSERT INTO membro
(codEquipe, codFuncionario)
values (1, 1);

INSERT INTO membro
(codEquipe, codFuncionario)
values (1, 2);

INSERT INTO membro
(codEquipe, codFuncionario)
values (1, 3);

INSERT INTO membro
(codEquipe, codFuncionario)
values (1, 4);

INSERT INTO equipe
(nomeEquipe)
values ('Amazon');

INSERT INTO membro
(codEquipe, codFuncionario)
values (1, 7);

INSERT INTO membro
(codEquipe, codFuncionario)
values (1, 8);

INSERT INTO membro
(codEquipe, codFuncionario)
values (1, 9);

INSERT INTO membro
(codEquipe, codFuncionario)
values (1, 10);

INSERT INTO projeto(descricao, depto, responsavel, DataInicio, DataFim, situacao, equipe)
values ('APF', 2, 2, '2018-02-26', '2018-06-30', 'Em andamento', 2);

INSERT INTO projeto(descricao, depto, responsavel, DataInicio, DataFim, situacao, equipe)
values ('Monitoria', 1, 2, '2018-02-26', '2018-06-30', 'Planejado', 1);

INSERT INTO projeto(descricao, depto, responsavel, DataInicio, DataFim, situacao, equipe)
values ('BD', 2, 1, '2018-02-26', '2018-06-30', 'Em andamento', 1);

INSERT INTO projeto(descricao, depto, responsavel, DataInicio, DataFim, dataConclusao, situacao, equipe)
values ('ES', 1, 1, '2018-02-26', '2018-06-30', '2018-05-29', 'Concluído', 1);


INSERT INTO atividade(descricao, dataInicio, dataFim, situacao, dataConclusao)
    VALUES ('Preparar calendário', '2018-02-26', '2020-11-01', 'Concluído', '2020-10-01');
INSERT INTO atividade(descricao, dataInicio, dataFim, situacao, dataConclusao)
    VALUES ('Preparar calendário', '2018-02-26', '2020-11-10', 'Concluído', '2020-10-02');
INSERT INTO atividade(descricao, dataInicio, dataFim, situacao, dataConclusao)
    VALUES ('Consultar direção', '2018-02-26', '2020-11-02', 'Planejado', CURRENT_DATE);
INSERT INTO atividade(descricao, dataInicio, dataFim, situacao, dataConclusao)
    VALUES ('Consultar direção', '2018-02-26', '2020-11-03', 'Em andamento', CURRENT_DATE);
INSERT INTO atividade(descricao, dataInicio, dataFim, situacao, dataConclusao)
    VALUES ('Consultar direção', '2018-02-26', '2020-11-04', 'Planejado', CURRENT_DATE);
INSERT INTO atividade(descricao, dataInicio, dataFim, situacao, dataConclusao)
    VALUES ('Emitir prestação de contas', '2018-02-26', '2020-11-10', 'Em andamento', CURRENT_DATE);

INSERT INTO atividade_membro(codAtividade, codMembro)
    VALUES (1, 1);
INSERT INTO atividade_membro(codAtividade, codMembro)
    VALUES (2, 2);
INSERT INTO atividade_membro(codAtividade, codMembro)
    VALUES (3, 3);
INSERT INTO atividade_membro(codAtividade, codMembro)
    VALUES (4, 4);
INSERT INTO atividade_membro(codAtividade, codMembro)
    VALUES (5, 5);
INSERT INTO atividade_membro(codAtividade, codMembro)
    VALUES (1, 6);
INSERT INTO atividade_membro(codAtividade, codMembro)
    VALUES (1, 7);
INSERT INTO atividade_membro(codAtividade, codMembro)
    VALUES (2, 8);

INSERT INTO atividade_projeto(codAtividade, codProjeto)
    VALUES (1, 1);
INSERT INTO atividade_projeto(codAtividade, codProjeto)
    VALUES (2, 2);
INSERT INTO atividade_projeto(codAtividade, codProjeto)
    VALUES (3, 2);
INSERT INTO atividade_projeto(codAtividade, codProjeto)
    VALUES (4, 3);
INSERT INTO atividade_projeto(codAtividade, codProjeto)
    VALUES (5, 4);
INSERT INTO atividade_projeto(codAtividade, codProjeto)
    VALUES (6, 2);