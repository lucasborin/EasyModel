CREATE TABLE modelo (
	idModelo int NOT NULL AUTO_INCREMENT,	
	sigla varchar(5) NOT NULL,
	nome varchar(50) NOT NULL,
	descricao text,
	PRIMARY KEY (idModelo),
	UNIQUE KEY (sigla)
);

CREATE TABLE nivelCapacidade (
	idNivelCapacidade int NOT NULL AUTO_INCREMENT,
	sigla varchar(5) NOT NULL,
	nome varchar(50) NOT NULL,
	descricao text,
	PRIMARY KEY (idNivelCapacidade),
	UNIQUE KEY (sigla)
);

CREATE TABLE metaGenerica (	
	idMetaGenerica int NOT NULL AUTO_INCREMENT,
	sigla varchar(5) NOT NULL,
	nome varchar(50) NOT NULL,
	descricao text,
	idModelo int NOT NULL,
	idNivelCapacidade int NOT NULL,
	PRIMARY KEY (idMetaGenerica),
	UNIQUE KEY (sigla),
	FOREIGN KEY (idModelo) REFERENCES modelo(idModelo),
	FOREIGN KEY (idNivelCapacidade) REFERENCES nivelCapacidade(idNivelCapacidade)
);

CREATE TABLE nivelMaturidade (
	idNivelMaturidade int NOT NULL AUTO_INCREMENT,
	sigla varchar(5) NOT NULL,
	nome varchar(50) NOT NULL,
	descricao text,
	PRIMARY KEY (idNivelMaturidade),
	UNIQUE KEY (sigla)
);

CREATE TABLE categoria (
	idCategoria int NOT NULL AUTO_INCREMENT,
	nome varchar(50) NOT NULL,
	PRIMARY KEY (idCategoria),
	UNIQUE KEY (nome)
);

CREATE TABLE areaProcesso (
	idAreaProcesso int NOT NULL AUTO_INCREMENT,
	sigla varchar(5) NOT NULL,
	nome varchar(50) NOT NULL,
	descricao text,
	idCategoria int NOT NULL,
	idNivelMaturidade int NOT NULL,
	idModelo int NOT NULL,
	PRIMARY KEY (idAreaProcesso),
	UNIQUE KEY (sigla),
	FOREIGN KEY (idCategoria) REFERENCES categoria(idCategoria),
	FOREIGN KEY (idNivelMaturidade) REFERENCES nivelMaturidade(idNivelMaturidade),
	FOREIGN KEY (idModelo) REFERENCES modelo(idModelo)
);

CREATE TABLE metaEspecifica (
	idMetaEspecifica int NOT NULL AUTO_INCREMENT,
	sigla varchar(5) NOT NULL,
	nome varchar(50) NOT NULL,
	descricao text,
	idAreaProcesso int NOT NULL,
	PRIMARY KEY (idMetaEspecifica),
	UNIQUE KEY (sigla),	
	FOREIGN KEY (idAreaProcesso) REFERENCES areaProcesso(idAreaProcesso)
);

CREATE TABLE praticaEspecifica (
	idPraticaEspecifica int NOT NULL AUTO_INCREMENT,
	sigla varchar(5) NOT NULL,
	nome varchar(50) NOT NULL,
	descricao text,
	idMetaEspecifica int NOT NULL,
	PRIMARY KEY (idPraticaEspecifica),
	UNIQUE KEY (sigla),
	FOREIGN KEY (idMetaEspecifica) REFERENCES metaEspecifica(idMetaEspecifica)
);

CREATE TABLE produtoTrabalho (
	idProdutoTrabalho int NOT NULL AUTO_INCREMENT,
	nome varchar(50) NOT NULL,
	template varchar(50) NOT NULL,
	PRIMARY KEY (idProdutoTrabalho),
	UNIQUE KEY (nome)
);

CREATE TABLE produtoTrabalhoPraticaEspecifica (
	idProdutoTrabalho int NOT NULL,
	idPraticaEspecifica int NOT NULL,
	PRIMARY KEY (idProdutoTrabalho, idPraticaEspecifica),
	FOREIGN KEY (idProdutoTrabalho) REFERENCES produtoTrabalho(idProdutoTrabalho),
	FOREIGN KEY (idPraticaEspecifica) REFERENCES praticaEspecifica(idPraticaEspecifica)
);