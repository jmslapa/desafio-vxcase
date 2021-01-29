create database vxcase default character set utf8mb4 collate utf8mb4_unicode_ci;

use vxcase;

create table produto(
	id bigint unsigned not null auto_increment primary key,
    nome varchar(50) not null,
    preco decimal(8,2) not null,    
    entrega tinyint not null,
    slug varchar(50) not null,
    capa varchar(255),
    criacao datetime,
    atualizacao datetime,
    
    constraint uc_produto unique(slug)
);

create table venda (
	id bigint unsigned not null auto_increment primary key,
    momento datetime not null,
    criacao datetime,
    atualizacao datetime
);

create table produto_venda (
	produto_id bigint unsigned not null,
    venda_id bigint unsigned not null,
	preco decimal(8,2) not null,
    
    constraint fk_produto_venda_produto_id foreign key (produto_id) references produto(id),
    constraint fk_produto_venda_venda_id foreign key (venda_id) references venda(id),
    constraint pk_produto_venda primary key (produto_id, venda_id)
);