-- -----------------------------------------------------
-- Schema Gaan
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `Gaan` ;

-- -----------------------------------------------------
-- Schema Gaan
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `Gaan` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
USE `Gaan` ;

-- -----------------------------------------------------
-- Table `Gaan`.`Perfil`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Gaan`.`Perfil` ;

CREATE TABLE IF NOT EXISTS `Gaan`.`Perfil` (
  `idPerfil` INT NOT NULL AUTO_INCREMENT,
  `tipo` ENUM("user", "admin") NOT NULL,
  `descricao` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idPerfil`));

INSERT INTO `Gaan`.`Perfil`(`tipo`, `descricao`)VALUES
	('admin', 'funcionario'),
	('user', 'utente'),
	('user', 'familiar');
-- -----------------------------------------------------
-- Table `Gaan`.`User`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Gaan`.`User` ;

CREATE TABLE IF NOT EXISTS `Gaan`.`User` (
  `idUser` INT NOT NULL AUTO_INCREMENT,
  `idPerfil` INT NOT NULL,
  `nome` VARCHAR(50) NOT NULL,
  `apelido` VARCHAR(50) NOT NULL,
  `estadoCivil` VARCHAR(10) NULL,
  `dataNascimento` DATE NULL,
  `identificacao` VARCHAR(15) NOT NULL,
  `validadeIdentificacao` DATE NOT NULL,
  `naturalidade` VARCHAR(50) NULL,
  `nif` INT(9) NULL,
  `sns` INT(9) NULL,
  `ss` INT(11) NULL,
  `rua` VARCHAR(100) NOT NULL,
  `numero` SMALLINT(10) NULL,
  `andar` SMALLINT(3) NULL,
  `lado` VARCHAR(15) NULL,
  `cp` VARCHAR(8) NOT NULL,
  `localidade` VARCHAR(50) NOT NULL,
  `telefone` VARCHAR(14) NULL,
  `telemovel` VARCHAR(14) NOT NULL,
  `email` VARCHAR(50) NOT NULL,
  `senha` VARCHAR(255) NOT NULL,
  `dataRegisto` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `ultModificacao` DATETIME NULL,
  `estado` ENUM("ativo", "inativo") NULL,

  PRIMARY KEY (`idUser`, `nif`, `identificacao`, `sns`, `ss`),
  FOREIGN KEY (`idPerfil`) REFERENCES `Gaan`.`Perfil` (`idPerfil`) ON DELETE NO ACTION ON UPDATE NO ACTION
  );

INSERT INTO `Gaan`.`User`(`nome`, `apelido`, `estadoCivil`, `dataNascimento`, `identificacao`, `validadeIdentificacao`, `nif`, `sns`, `ss`, `rua`, `numero`, `andar`, `lado`, `cp`, `localidade`, `telefone`, `telemovel`, `email`, `senha`, `idPerfil`, `naturalidade`)
VALUES
    ('João', 'Silva', 'Solteiro', '1990-05-15', '123456789', '2023-06-10', 123456789, 123456789, 123456789, 'Rua A', 10, 1, '1.º Dt.º', '12345', 'Lisboa', '123456789', '987654321', 'joao.silva@email.com', '$2y$10$533q68POY8bsEVN1Jhp9AeG.LdqMTr.R/mR/pfh.ZkQ4tUp2Dp85K', 2, 'Lisboa'),
    ('Maria', 'Santos', 'Casado', '1985-10-20', '987654321', '2023-06-10', 987654321, 987654321, 987654321, 'Rua B', 20, 2, '2.º Esq.º', '54321', 'Porto', '987654321', '123456789', 'maria.santos@email.com', '$2y$10$CnZK79fZKp83Du0ouRzUfuzVAF2LpaFImEC8Wpb0FiyXpBB59vliW', 2, 'Porto'),
    ('Carlos', 'Ferreira', 'Solteiro', '1992-03-25', '456789123', '2023-06-10', 456789123, 456789123, 456789123, 'Rua C', 30, 3, '3.º Dt.º', '13579', 'Coimbra', '456789123', '987654321', 'carlos.ferreira@email.com', '$2y$10$ieQp8j96eVgeE6BxtRXulews.uMV7E33GQ89x18rJGGyu5gp2Q5wi', 1, 'Coimbra'),
    ('Ana', 'Ribeiro', 'Casado', '1988-12-05', '789123456', '2023-06-10', 789123456, 789123456, 789123456, 'Rua D', 40, 4, '4.º Esq.º', '97531', 'Braga', '789123456', '123456789', 'ana.ribeiro@email.com', '$2y$10$3VfRuKqfeK9eyCm7B7Rvi.2JRVp8L03x3F6lQwOk6bw5P7NSu3Nba', 1, 'Braga'),
    ('Pedro', 'Gomes', 'Solteiro', '1995-08-30', '321654987', '2023-06-10', 321654987, 321654987, 321654987, 'Rua E', 50, 5, '5.º Dt.º', '24680', 'Faro', '321654987', '987654321', 'pedro.gomes@email.com', '$2y$10$dzAukTFUauRh/fbsGiVozOdf6g1aj98TGO2PvdlHWTPiTAP8/SFMK', 1, 'Faro'),
	('José', 'Pereira', 'Solteiro', '1991-07-20', '987654321', '2023-06-10', 987654790, 987654790, 987654790, 'Rua F', 15, 1, '1.º Esq.º', '54321', 'Porto', '987654790', '123456789', 'jose.pereira@email.com', '$2y$10$8kvo8ToMWLD/TueZ4SCmSudgTNMBXR3YUSij5T.Ij4yNlRsydWv62', 3, 'Porto'),
    ('Mariana', 'Costa', 'Casado', '1987-03-10', '123456789', '2023-06-10', 123456790, 123456790, 123456790, 'Rua G', 25, 2, '2.º Dt.º', '12345', 'Lisboa', '123456790', '987654321', 'mariana.costa@email.com', '$2y$10$uxEk6i6ZVX0R/UM64bN2PePeJ1SRlX4FUqC971Dq.zWZ/WG8wad5i', 3, 'Lisboa'),
    ('Paulo', 'Almeida', 'Solteiro', '1993-11-15', '456789123', '2023-06-10', 456789124, 456789124, 456789124, 'Rua H', 35, 3, '3.º Esq.º', '13579', 'Coimbra', '456789124', '987654321', 'paulo.almeida@email.com', '$2y$10$.hM2nPqloakjOMA9CrZ6EeWNjL0Bpjr0DgUPg5aR2VpuPiTFBs9yO', 3, 'Coimbra'),
    ('Sofia', 'Lima', 'Casado', '1989-05-25', '789123456', '2023-06-10', 789123457, 789123457, 789123457, 'Rua I', 45, 4, '4.º Dt.º', '97531', 'Braga', '789123457', '123456789', 'sofia.lima@email.com', '$2y$10$1HZh6VMrTz/SxWYk1kl3VOpcfhAaF0IqsEbBSjaJTTNmCS2CLhupK', 3, 'Braga'),
    ('Rui', 'Carvalho', 'Solteiro', '1996-09-30', '321654987', '2023-06-10', 321654988, 321654988, 321654988, 'Rua J', 55, 5, '5.º Esq.º', '24680', 'Faro', '321654988', '987654321', 'rui.carvalho@email.com', '$2y$10$ADMQk7sDR5ESpRAVzO2vi.Af2Sb7s4pxBj3GhckfdFZsaPC9CPGEq', 3, 'Faro'),
    ('André', 'Oliveira', 'Casado', '1994-04-10', '135792468', '2023-06-10', 135792468, 135792468, 135792468, 'Rua K', 60, 6, '6.º Dt.º', '13579', 'Coimbra', '135792468', '987654321', 'andre.oliveira@email.com', '$2y$10$uYLLebqwxGBIr/X9qFslFOuBZTmR1f3P8ztChO613QWXPSFQlNVHO', 2, 'Coimbra'),
	('Marta', 'Fernandes', 'Solteiro', '1997-02-28', '975310246', '2023-06-10', 975310246, 975310246, 975310246, 'Rua L', 70, 7, '7.º Esq.º', '97531', 'Braga', '975310246', '123456789', 'marta.fernandes@email.com', '$2y$10$8ENn6AZIbuNIp1yxhC8qPuS6Ovq9LjlW6n8A/8PGkn/nS9bm7GxKO', 2, 'Braga'),
	('Hugo', 'Rodrigues', 'Casado', '1986-09-12', '864209753', '2023-06-10', 864209753, 864209753, 864209753, 'Rua M', 80, 8, '8.º Dt.º', '86420', 'Faro', '864209753', '987654321', 'hugo.rodrigues@email.com', '$2y$10$NJeKeiaMDZQ93yCSbHri0.xgjm3NP6xH7.eVWVOlI0.osWwhzrx66', 2, 'Faro'),
	('Sara', 'Moreira', 'Solteiro', '1993-07-05', '753019864', '2023-06-10', 753019864, 753019864, 753019864, 'Rua N', 90, 9, '9.º Esq.º', '75301', 'Porto', '753019864', '123456789', 'sara.moreira@email.com', '$2y$10$7quRZnaomUy7jid1Y8YmdeODznaILVODozJAv7dP.vvu0PXUYIlFa', 2, 'Porto'),
	('Ricardo', 'Machado', 'Casado', '1988-11-25', '582960147', '2023-06-10', 582960147, 582960147, 582960147, 'Rua O', 100, 10, '10.º Dt.º', '58296', 'Lisboa', '582960147', '987654321', 'ricardo.machado@email.com', '$2y$10$0Gxkh.ILveR5hesVp9O7CO6r0spRML.jnnbolkMR0DFBUxnUIDGPi', 2, 'Lisboa')
	ON DUPLICATE KEY UPDATE `nif` = `nif` + 1;


-- -----------------------------------------------------
-- Table `Gaan`.`Responsavel_Utente`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Gaan`.`ResponsavelUtente` ;

CREATE TABLE IF NOT EXISTS `Gaan`.`ResponsavelUtente` (
  `idUserUtente` INT NOT NULL,
  `idUserResponsavel` INT NOT NULL,
  `parentesco` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`idUserUtente`, `idUserResponsavel`),
  FOREIGN KEY (`idUserUtente`) REFERENCES `Gaan`.`User` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  FOREIGN KEY (`idUserResponsavel`) REFERENCES `Gaan`.`User` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION
  );
-- -----------------------------------------------------
-- Table `Gaan`.`Entidade`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Gaan`.`Entidade` ;

CREATE TABLE IF NOT EXISTS `Gaan`.`Entidade` (
  `idEntidade` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `nif` INT(9) NOT NULL,
  `nipc` INT(9) NOT NULL,
  `cae` INT(5) NOT NULL,
  `ss` INT(9) NOT NULL,
  `rua` VARCHAR(100) NOT NULL,
  `numero` SMALLINT(10) NULL,
  `andar` SMALLINT(3) NULL,
  `lado` VARCHAR(15) NULL,
  `cp` VARCHAR(8) NOT NULL,
  `localidade` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`idEntidade`));

-- -----------------------------------------------------
-- Table `Gaan`.`Entidade_User`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Gaan`.`EntidadeUser` ;

CREATE TABLE IF NOT EXISTS `Gaan`.`EntidadeUser` (
  `idEntidade` INT NOT NULL,
  `idUser` INT NOT NULL,
  PRIMARY KEY (`idEntidade`, `idUser`),
  FOREIGN KEY (`idEntidade`) REFERENCES `Gaan`.`Entidade` (`idEntidade`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  FOREIGN KEY (`idUser`) REFERENCES `Gaan`.`User` (`idUser`) ON DELETE NO ACTION  ON UPDATE NO ACTION
  );
-- -----------------------------------------------------
-- Table `Gaan`.`Mensagem`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Gaan`.`Mensagem` ;

CREATE TABLE IF NOT EXISTS `Gaan`.`Mensagem` (
  `idMensagem` INT NOT NULL AUTO_INCREMENT,
  `idEmissor` INT NOT NULL,
  `idRecetor` INT NOT NULL,
  `mensagem` VARCHAR(500) NOT NULL,
  `dataEnvio` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `lida` ENUM("S", "N") NOT NULL,
  `anexo` VARCHAR(150) NULL,
  PRIMARY KEY (`idMensagem`, `idEmissor`, `idRecetor`),
  FOREIGN KEY (`idRecetor`) REFERENCES `Gaan`.`User` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  FOREIGN KEY (`idEmissor`) REFERENCES `Gaan`.`User` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION
  );


-- -----------------------------------------------------
-- Table `Gaan`.`Documento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Gaan`.`Documento` ;

CREATE TABLE IF NOT EXISTS `Gaan`.`Documento` (
  `idDocumento` INT NOT NULL AUTO_INCREMENT,
  `caminho` VARCHAR(150) NOT NULL,
  `tipo` VARCHAR(45) NOT NULL,
  `origem` VARCHAR(45) NOT NULL,
  `idIdoso` INT NOT NULL,
  `idFuncResponsavel` INT NOT NULL,
  PRIMARY KEY (`idDocumento`),
  FOREIGN KEY (`idIdoso`) REFERENCES `Gaan`.`User` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  FOREIGN KEY (`idFuncResponsavel`) REFERENCES `Gaan`.`User` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION
  );


-- -----------------------------------------------------
-- Table `Gaan`.`Inscricao`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Gaan`.`Inscricao` ;

CREATE TABLE IF NOT EXISTS `Gaan`.`Inscricao` (
  `idInscricao` INT NOT NULL AUTO_INCREMENT, 
  `idUserUtente` INT NOT NULL, 
  `idUserResponsavel` INT NOT NULL,
  `tipoServico` VARCHAR(45) NOT NULL,
  `motivoInscricao` VARCHAR(45) NULL,
  `alimentacao` ENUM("SIM", "NÃO") NOT NULL,
  `semanal` ENUM("SIM", "NÃO") NOT NULL,
  `fdsFeriados` ENUM("SIM", "NÃO") NOT NULL,
  `higienePessoal` ENUM("SIM", "NÃO") NOT NULL,
  `higieneHabitacional` ENUM("SIM", "NÃO") NOT NULL,
  `tratamentoRoupa` ENUM("SIM", "NÃO") NOT NULL,
  `doencaInfetoconta` ENUM("SIM","NÃO") NOT NULL,
  `doencaMental` ENUM("SIM","NÃO") NOT NULL,
  `socioGrupoAmigos` ENUM("SIM","NÃO") NOT NULL,
  `dataInscricao` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `assinatura` VARCHAR(45) NOT NULL,
  
  `observacao` TEXT NULL,
  `relatorio` TEXT NULL,
  `grauAutonomia` INT(1) NULL,
  `comQuemVive` INT(1) NULL,
  `temApoioAlguem` INT(1) NULL,
  `motivoSolicitacao` INT(1) NULL,
  `serSocio` INT(1) NULL,
  `pontuacaoCriterio` INT(2) NULL,
  `tecnicoVisitou` VARCHAR(50) NULL,
  `dataVisitaDomicilio` DATE NULL,
  
  `respostaServico` VARCHAR(45) NOT NULL,
  `dataResposta` DATE NULL,
  `tecnicoRespondeu` VARCHAR(50) NULL,
  
  PRIMARY KEY (`idInscricao`,`idUserUtente`),
  FOREIGN KEY (`idUserUtente`) REFERENCES `Gaan`.`User` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION
  ); 


-- INSERIR DADOS NA TABELA INSCRIÇÃO
TRUNCATE TABLE Inscricao;
INSERT INTO `inscricao` (`idInscricao`, `idUserUtente`, `idUserResponsavel`, `tipoServico`, `motivoInscricao`, `alimentacao`, `semanal`, `fdsFeriados`, `higienePessoal`, `higieneHabitacional`, `tratamentoRoupa`, `doencaInfetoconta`, `doencaMental`, `socioGrupoAmigos`, `dataInscricao`, `assinatura`, `observacao`, `relatorio`, `grauAutonomia`, `comQuemVive`, `temApoioAlguem`, `motivoSolicitacao`, `serSocio`, `pontuacaoCriterio`, `tecnicoVisitou`, `dataVisitaDomicilio`, `respostaServico`, `dataResposta`, `tecnicoRespondeu`) VALUES
(1, 11, 6, 'Centro de Convívio', 'Necessidade de mobilização', 'SIM', 'SIM', 'SIM', 'SIM', 'SIM', 'SIM', 'NÃO', 'NÃO', 'SIM', '2023-06-17', 'José Pereira', 'Observações sobre a inscrição', 'Relatório da visita domiciliária<br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam voluptatum laudantium totam commodi similique eius iusto. Consequatur harum nam nulla ducimus. Vel quis culpa veritatis autem ratione suscipit aliquam voluptate.', 1, 4, 3, 2, 3, 13, 'Pedro Gomes', '2023-06-17', 'Manutenção em lista de espera', '2023-06-17', 'Pedro Gomes'),
(2, 12, 6, 'Centro de Convívio', 'Necessidade de mobilização', 'SIM', 'SIM', 'SIM', 'SIM', 'SIM', 'SIM', 'NÃO', 'NÃO', 'SIM', '2023-06-17', 'José Pereira', 'Observações sobre a inscrição', 'Relatório da visita domiciliária<br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam voluptatum laudantium totam commodi similique eius iusto. Consequatur harum nam nulla ducimus. Vel quis culpa veritatis autem ratione suscipit aliquam voluptate.', 1, 4, 3, 2, 3, 13, 'Pedro Gomes', '2023-06-17', 'Manutenção em lista de espera', '2023-06-17', 'Pedro Gomes'),
(3, 13, 6, 'Centro de Convívio', 'Necessidade de mobilização', 'SIM', 'SIM', 'SIM', 'SIM', 'SIM', 'SIM', 'NÃO', 'NÃO', 'SIM', '2023-06-17', 'José Pereira', 'Observações sobre a inscrição', 'Relatório da visita domiciliária<br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam voluptatum laudantium totam commodi similique eius iusto. Consequatur harum nam nulla ducimus. Vel quis culpa veritatis autem ratione suscipit aliquam voluptate.', 1, 4, 3, 2, 3, 13, 'Pedro Gomes', '2023-06-17', 'Manutenção em lista de espera', '2023-06-17', 'Pedro Gomes'),
(4, 14, 6, 'Centro de Convívio', 'Necessidade de mobilização', 'SIM', 'SIM', 'SIM', 'SIM', 'SIM', 'SIM', 'NÃO', 'NÃO', 'SIM', '2023-06-17', 'José Pereira', 'Observações sobre a inscrição', 'Relatório da visita domiciliária<br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam voluptatum laudantium totam commodi similique eius iusto. Consequatur harum nam nulla ducimus. Vel quis culpa veritatis autem ratione suscipit aliquam voluptate.', 1, 4, 3, 2, 3, 13, 'Pedro Gomes', '2023-06-17', 'Manutenção em lista de espera', '2023-06-17', 'Pedro Gomes'),
(5, 15, 6, 'Centro de Convívio', 'Necessidade de mobilização', 'SIM', 'SIM', 'SIM', 'SIM', 'SIM', 'SIM', 'NÃO', 'NÃO', 'SIM', '2023-06-17', 'José Pereira', 'Observações sobre a inscrição', 'Relatório da visita domiciliária<br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam voluptatum laudantium totam commodi similique eius iusto. Consequatur harum nam nulla ducimus. Vel quis culpa veritatis autem ratione suscipit aliquam voluptate.', 1, 4, 3, 2, 3, 13, 'Pedro Gomes', '2023-06-17', 'Manutenção em lista de espera', '2023-06-17', 'Pedro Gomes');
-- -----------------------------------------------------
-- Table `Gaan`.`Processo_Saude`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Gaan`.`ProcessoSaude` ;

CREATE TABLE IF NOT EXISTS `Gaan`.`ProcessoSaude` (
  `idProcessoSaude` INT NOT NULL AUTO_INCREMENT,
  `idResponsavelUtente` INT NOT NULL,
  `idUtente` INT NOT NULL,
  PRIMARY KEY (`idProcessoSaude`, `idUtente`),
  FOREIGN KEY (`idUtente`) REFERENCES `Gaan`.`User` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION
  );


-- -----------------------------------------------------
-- Table `Gaan`.`Apoio_Estrutura_Saude`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Gaan`.`ApoioEstruturaSaude` ;

CREATE TABLE IF NOT EXISTS `Gaan`.`ApoioEstruturaSaude` (
  `idApoioEstruturaSaude` INT NOT NULL AUTO_INCREMENT,
  `medicoFamilia` VARCHAR(100) NOT NULL,
  `centroSaude` VARCHAR(100) NOT NULL,
  `telefone` VARCHAR(14) NOT NULL,
  `medicoEspecialista` VARCHAR(100) NOT NULL,
  `especialidade` VARCHAR(100) NOT NULL,
  `contatoEspecialidade` VARCHAR(100) NOT NULL,
  `outrosProfissionaisSaude` VARCHAR(100) NULL,
  `idProcessoSaude` INT NOT NULL,
  PRIMARY KEY (`idApoioEstruturaSaude`, `idProcessoSaude`),
  FOREIGN KEY (`idProcessoSaude`) REFERENCES `Gaan`.`ProcessoSaude` (`idProcessoSaude`) ON DELETE NO ACTION ON UPDATE NO ACTION
  );


-- -----------------------------------------------------
-- Table `Gaan`.`Antecedente`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Gaan`.`Antecedente` ;

CREATE TABLE IF NOT EXISTS `Gaan`.`Antecedente` (
  `idAntecidente` INT NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(45) NOT NULL,
  `data` DATE NULL,
  `idProcessoSaude` INT NOT NULL,
  PRIMARY KEY (`idAntecidente`),
  FOREIGN KEY (`idProcessoSaude`) REFERENCES `Gaan`.`ProcessoSaude` (`idProcessoSaude`) ON DELETE NO ACTION ON UPDATE NO ACTION
    );


-- -----------------------------------------------------
-- Table `Gaan`.`Prescricao`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Gaan`.`Prescricao` ;

CREATE TABLE IF NOT EXISTS `Gaan`.`Prescricao` (
  `idPrescricao` INT NOT NULL AUTO_INCREMENT,
  `medicamento` VARCHAR(100) NOT NULL,
  `prescritor` VARCHAR(100) NOT NULL,
  `jejum` ENUM("SIM", "NÃO") NOT NULL,
  `preAlmoco` ENUM("SIM", "NÃO") NOT NULL,
  `almoco` ENUM("SIM", "NÃO") NOT NULL,
  `jantar` ENUM("SIM", "NÃO") NOT NULL,
  `deitar` ENUM("SIM", "NÃO") NOT NULL,
  `data` DATE NOT NULL,
  `obs` TEXT NULL,
  `idProcessoSaude` INT NOT NULL,
  PRIMARY KEY (`idPrescricao`),
  FOREIGN KEY (`idProcessoSaude`) REFERENCES `Gaan`.`ProcessoSaude` (`idProcessoSaude`) ON DELETE NO ACTION ON UPDATE NO ACTION
  );


-- -----------------------------------------------------
-- Table `Gaan`.`Registo_GTA`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Gaan`.`RegistoGTA` ;

CREATE TABLE IF NOT EXISTS `Gaan`.`RegistoGTA` (
  `idRegistoGTA` INT NOT NULL AUTO_INCREMENT,
  `tensaoArterial` DECIMAL(10,3) NULL,
  `pulso` DECIMAL(10,3) NOT NULL,
  `glicemia` DECIMAL(10,3) NOT NULL,
  `data` DATE NOT NULL,
  `nota` TEXT NULL,
  `idProcessoSaude` INT NOT NULL,
  PRIMARY KEY (`idRegistoGTA`),
  FOREIGN KEY (`idProcessoSaude`) REFERENCES `Gaan`.`ProcessoSaude` (`idProcessoSaude`) ON DELETE NO ACTION ON UPDATE NO ACTION
  );


-- -----------------------------------------------------
-- Table `Gaan`.`Evolucao_Saude`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Gaan`.`EvolucaoSaude` ;

CREATE TABLE IF NOT EXISTS `Gaan`.`EvolucaoSaude` (
  `idEvolucaoSaude` INT NOT NULL AUTO_INCREMENT,
  `inicio` DATE NOT NULL,
  `fim` DATE NULL,
  `idProcessoSaude` INT NOT NULL,
  PRIMARY KEY (`idEvolucaoSaude`, `idProcessoSaude`),
  FOREIGN KEY (`idProcessoSaude`) REFERENCES `Gaan`.`ProcessoSaude` (`idProcessoSaude`) ON DELETE NO ACTION ON UPDATE NO ACTION
  );


-- -----------------------------------------------------
-- Table `Gaan`.`Detalhe_Evolucao`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Gaan`.`DetalheEvolucao` ;

CREATE TABLE IF NOT EXISTS `Gaan`.`DetalheEvolucao` (
  `idDetalheEvolucao` INT NOT NULL,
  `acontecimento` VARCHAR(500) NOT NULL,
  `acao` VARCHAR(500) NOT NULL,
  `idEvolucaoSaude` INT NOT NULL,
  PRIMARY KEY (`idDetalheEvolucao`),
  FOREIGN KEY (`idEvolucaoSaude`) REFERENCES `Gaan`.`EvolucaoSaude` (`idEvolucaoSaude`) ON DELETE NO ACTION ON UPDATE NO ACTION
  );


-- -----------------------------------------------------
-- Table `Gaan`.`iProcessoUtente`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Gaan`.`ProcessoUtente` ;

CREATE TABLE IF NOT EXISTS `Gaan`.`ProcessoUtente` (
  `idProcessoUtente` INT NOT NULL AUTO_INCREMENT,
  `idUserUtente` INT NOT NULL,
  `socioNumero` INT NOT NULL,
  `contratoNumero` INT NOT NULL,
  `dataSaida` DATE NULL,
  `motivoSaida` VARCHAR(100) NULL,
  `historiaVida` TEXT NULL,
  `habilitLiteraria` VARCHAR(250) NULL,
  `gostosPessoais` VARCHAR(500) NULL,
  `problemaSaude` VARCHAR(200) NULL,
  `tipoAlimentacao` VARCHAR(200) NULL,
  PRIMARY KEY (`idProcessoUtente`, `socioNumero`, `contratoNumero`, `idUserUtente`),
  FOREIGN KEY (`idUserUtente`) REFERENCES `Gaan`.`User` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION
  );


-- -----------------------------------------------------
-- Table `Gaan`.`Com_Quem_Vive`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Gaan`.`ComQuemVive` ;

CREATE TABLE IF NOT EXISTS `Gaan`.`ComQuemVive` (
  `idComQuemVive` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `contato` VARCHAR(45) NOT NULL,
  `parentesco` VARCHAR(45) NOT NULL,
  `idProcessoUtente` INT NOT NULL,
  PRIMARY KEY (`idComQuemVive`),
  FOREIGN KEY (`idProcessoUtente`) REFERENCES `Gaan`.`ProcessoUtente` (`idProcessoUtente`) ON DELETE NO ACTION ON UPDATE NO ACTION
  );
-- -----------------------------------------------------
-- Table `Gaan`.`Contexto_Familiar`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Gaan`.`ContextoFamiliar` ;

CREATE TABLE IF NOT EXISTS `Gaan`.`ContextoFamiliar` (
  `idContextoFamiliar` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `morada` VARCHAR(150) NOT NULL,
  `parentesco` VARCHAR(45) NOT NULL,
  `telefoneCasa` VARCHAR(14) NULL,
  `telefoneEmprego` VARCHAR(14) NULL,
  `telemovel` VARCHAR(14) NOT NULL,
  `idProcessoUtente` INT NOT NULL,
  PRIMARY KEY (`idContextoFamiliar`),
  FOREIGN KEY (`idProcessoUtente`) REFERENCES `Gaan`.`ProcessoUtente` (`idProcessoUtente`) ON DELETE NO ACTION ON UPDATE NO ACTION
  );


-- -----------------------------------------------------
-- Table `Gaan`.`Habitacao`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Gaan`.`Habitacao` ;

CREATE TABLE IF NOT EXISTS `Gaan`.`Habitacao` (
  `idHabitacao` INT NOT NULL AUTO_INCREMENT,
  `regimeHabitacional` VARCHAR(45) NOT NULL,
  `condicoesHabitacionais` VARCHAR(500) NOT NULL,
  `barreirasHabitacao` VARCHAR(500) NOT NULL,
  `outras` VARCHAR(500) NULL,
  `idProcessoUtente` INT NOT NULL,
  PRIMARY KEY (`idHabitacao`),
  FOREIGN KEY (`idProcessoUtente`) REFERENCES `Gaan`.`ProcessoUtente` (`idProcessoUtente`) ON DELETE NO ACTION ON UPDATE NO ACTION
  );


-- -----------------------------------------------------
-- Table `Gaan`.`Categoria_Diagnostico`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Gaan`.`CategoriaDiagnostico` ;

CREATE TABLE IF NOT EXISTS `Gaan`.`CategoriaDiagnostico` (
  `idCategoriaDiagnostico` INT NOT NULL AUTO_INCREMENT,
  `categoria` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`idCategoriaDiagnostico`)
  );


-- -----------------------------------------------------
-- Table `Gaan`.`SubCategoriaDiagnostico`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Gaan`.`SubCategoriaDiagnostico` ;

CREATE TABLE IF NOT EXISTS `Gaan`.`SubCategoriaDiagnostico` (
  `idSubCategoriaDiagnostico` INT NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(50) NOT NULL,
  `subCategoria` VARCHAR(100) NOT NULL,
  `idCategoriaDiagnostico` INT NOT NULL,
  PRIMARY KEY (`idSubCategoriaDiagnostico`),
  FOREIGN KEY (`idCategoriaDiagnostico`) REFERENCES `Gaan`.`CategoriaDiagnostico` (`idCategoriaDiagnostico`) ON DELETE NO ACTION ON UPDATE NO ACTION
  );


-- -----------------------------------------------------
-- Table `Gaan`.`Diagnostico`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Gaan`.`Diagnostico` ;

CREATE TABLE IF NOT EXISTS `Gaan`.`Diagnostico` (
  `idDiagnostico` INT NOT NULL,
  `diagnostico` VARCHAR(100) NOT NULL,
  `idProcessoUtente` INT NOT NULL,
  `idSubCategoriaDiagnostico` INT NOT NULL,
  PRIMARY KEY (`idDiagnostico`, `idProcessoUtente`, `idSubCategoriaDiagnostico`),
  FOREIGN KEY (`idProcessoUtente`) REFERENCES `Gaan`.`ProcessoUtente` (`idProcessoUtente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  FOREIGN KEY (`idSubCategoriaDiagnostico`) REFERENCES `Gaan`.`SubCategoriaDiagnostico` (`idSubCategoriaDiagnostico`) ON DELETE NO ACTION ON UPDATE NO ACTION
  );


-- -----------------------------------------------------
-- Table `Gaan`.`Deficiencia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Gaan`.`Deficiencia` ;

CREATE TABLE IF NOT EXISTS `Gaan`.`Deficiencia` (
  `idDeficiencia` INT NOT NULL AUTO_INCREMENT,
  `mental` VARCHAR(50) NOT NULL,
  `visual` VARCHAR(50) NOT NULL,
  `auditiva` VARCHAR(50) NOT NULL,
  `motora` VARCHAR(50) NOT NULL,
  `verbalizacao` VARCHAR(50) NOT NULL,
  `idProcessoUtente` INT NOT NULL,
  PRIMARY KEY (`idDeficiencia`),
  FOREIGN KEY (`idProcessoUtente`) REFERENCES `Gaan`.`ProcessoUtente` (`idProcessoUtente`) ON DELETE NO ACTION ON UPDATE NO ACTION
  );


-- -----------------------------------------------------
-- Table `Gaan`.`Orientacao`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Gaan`.`Orientacao` ;

CREATE TABLE IF NOT EXISTS `Gaan`.`Orientacao` (
  `idOrientacao` INT NOT NULL AUTO_INCREMENT,
  `espacial` VARCHAR(45) NOT NULL,
  `temporal` VARCHAR(45) NOT NULL,
  `idProcessoUtente` INT NOT NULL,
  PRIMARY KEY (`idOrientacao`),
  FOREIGN KEY (`idProcessoUtente`) REFERENCES `Gaan`.`ProcessoUtente` (`idProcessoUtente`) ON DELETE NO ACTION ON UPDATE NO ACTION
  );


-- -----------------------------------------------------
-- Table `Gaan`.`Grau_Dependencia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Gaan`.`GrauDependencia` ;

CREATE TABLE IF NOT EXISTS `Gaan`.`GrauDependencia` (
  `idGrauDependencia` INT NOT NULL AUTO_INCREMENT,
  `tomarBanho` ENUM("Independente", "Ajuda", "Dependente") NOT NULL,
  `vestirSe` ENUM("Independente", "Ajuda", "Dependente") NOT NULL,
  `irCasaBanho` ENUM("Independente", "Ajuda", "Dependente") NOT NULL,
  `transferencia` ENUM("Independente", "Ajuda", "Dependente") NOT NULL,
  `continencia` ENUM("Independente", "Ajuda", "Dependente") NOT NULL,
  `alimentacao` ENUM("Independente", "Ajuda", "Dependente") NOT NULL,
  `idProcessoUtente` INT NOT NULL,
  PRIMARY KEY (`idGrauDependencia`),
  FOREIGN KEY (`idProcessoUtente`) REFERENCES `Gaan`.`ProcessoUtente` (`idProcessoUtente`) ON DELETE NO ACTION ON UPDATE NO ACTION
  );


-- -----------------------------------------------------
-- Table `Gaan`.`Ajuda_Tecnica`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Gaan`.`AjudaTecnica` ;

CREATE TABLE IF NOT EXISTS `Gaan`.`AjudaTecnica` (
  `idAjudaTecnica` INT NOT NULL AUTO_INCREMENT,
  `situacao` VARCHAR(45) NOT NULL,
  `quais` VARCHAR(200) NULL,
  `idProcessoUtente` INT NOT NULL,
  PRIMARY KEY (`idAjudaTecnica`),
  FOREIGN KEY (`idProcessoUtente`) REFERENCES `Gaan`.`ProcessoUtente` (`idProcessoUtente`) ON DELETE NO ACTION ON UPDATE NO ACTION
  );


-- -----------------------------------------------------
-- Table `Gaan`.`PDIndividual` Plano de desnvolvimento individual
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Gaan`.`PDIndividual` ;

CREATE TABLE IF NOT EXISTS `Gaan`.`PDIndividual` (
  `idPDIndividual` INT NOT NULL AUTO_INCREMENT,
  `dataInicio` DATE NOT NULL,
  `atividade_vida` VARCHAR(100) NOT NULL,
  `necessidade` VARCHAR(100) NOT NULL,
  `acao` VARCHAR(100) NOT NULL,
  `recursos` VARCHAR(100) NOT NULL,
  `observacoes` VARCHAR(100) NOT NULL,
  `dataFim` DATE NULL,
  `idProcessoUtente` INT NOT NULL,
  PRIMARY KEY (`idPDIndividual`),
  FOREIGN KEY (`idProcessoUtente`) REFERENCES `Gaan`.`ProcessoUtente` (`idProcessoUtente`) ON DELETE NO ACTION ON UPDATE NO ACTION
  );


-- -----------------------------------------------------
-- Table `Gaan`.`ESSFamiliar` Evolução da situação sócio-familiar
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Gaan`.`ESSFamiliar` ;

CREATE TABLE IF NOT EXISTS `Gaan`.`ESSFamiliar` (
  `idESSFamiliar` INT NOT NULL AUTO_INCREMENT,
  `data` DATE NOT NULL,
  `descricao` VARCHAR(500) NOT NULL,
  `idProcessoUtente` INT NOT NULL,
  PRIMARY KEY (`idESSFamiliar`, `idProcessoUtente`),
  FOREIGN KEY (`idProcessoUtente`) REFERENCES `Gaan`.`ProcessoUtente` (`idProcessoUtente`) ON DELETE NO ACTION ON UPDATE NO ACTION
  );


-- -----------------------------------------------------
-- Table `Gaan`.`Registo_Ocorrencia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Gaan`.`RegistoOcorrencia` ;

CREATE TABLE IF NOT EXISTS `Gaan`.`RegistoOcorrencia` (
  `idRegistoOcorrencia` INT NOT NULL AUTO_INCREMENT,
  `acontecimento` VARCHAR(100) NOT NULL,
  `dataInicio` DATE NULL,
  `fimRubrica` DATE NULL,
  `idProcessoUtente` INT NOT NULL,
  PRIMARY KEY (`idRegistoOcorrencia`),
  FOREIGN KEY (`idProcessoUtente`) REFERENCES `Gaan`.`ProcessoUtente` (`idProcessoUtente`) ON DELETE NO ACTION ON UPDATE NO ACTION
  );


-- -----------------------------------------------------
-- Table `Gaan`.`Detalhe_Ocorrencia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Gaan`.`DetalheOcorrencia` ;

CREATE TABLE IF NOT EXISTS `Gaan`.`DetalheOcorrencia` (
  `idDetalheOcorrencia` INT NOT NULL AUTO_INCREMENT,
  `dataAcao` DATE NOT NULL,
  `acao` VARCHAR(100) NOT NULL,
  `idRegistoOcorrencia` INT NOT NULL,
  PRIMARY KEY (`idDetalheOcorrencia`),
  FOREIGN KEY (`idRegistoOcorrencia`) REFERENCES `Gaan`.`RegistoOcorrencia` (`idRegistoOcorrencia`) ON DELETE NO ACTION ON UPDATE NO ACTION
  );


-- -----------------------------------------------------
-- Table `Gaan`.`Rendimento_Mensal`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Gaan`.`Economia` ;

CREATE TABLE IF NOT EXISTS `Gaan`.`RendimentoMensal` (
  `idEcoMensal` INT NOT NULL AUTO_INCREMENT,
  `ano` VARCHAR(45) NOT NULL,
  `rendTrabalho` DECIMAL(10,4) NOT NULL,
  `reforma` DECIMAL(10,4) NOT NULL,
  `pensao` DECIMAL(10,4) NOT NULL,
  `complDepenCsi` DECIMAL(10,4) NOT NULL,
  `outrosrend` DECIMAL(10,4) NULL,
    `despMedicacao` DECIMAL(10,4) NOT NULL,
  `despRenda` DECIMAL(10,4) NOT NULL,
  `despAguaLuzGasTelefone` DECIMAL(10,4) NOT NULL,
  `despFraldas` DECIMAL(10,4) NOT NULL,
  `despOutros` VARCHAR(45) NOT NULL,
  `idProcessoUtente` INT NOT NULL,
  PRIMARY KEY (`idEcoMensal`, `idProcessoUtente`),
  FOREIGN KEY (`idProcessoUtente`) REFERENCES `Gaan`.`ProcessoUtente` (`idProcessoUtente`) ON DELETE NO ACTION ON UPDATE NO ACTION
  );


