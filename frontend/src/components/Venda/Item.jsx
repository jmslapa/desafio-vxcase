import React from 'react';
import Row from '../Row';

const Item = React.forwardRef(({item}, ref) => {
    
    return (
        <Row className="item" width="100%" justify="space-between" align="center">
            <Row align="center">    
                <img src={item.produto.capa} alt={`capa_produto_${item.produto.slug}`} className="capa"/>
                <div className="nome">{item.produto.nome}</div>
            </Row>
            <div className="separator"></div>
            <div className="valor">Valor: R$ {item.preco}</div>
        </Row>
    );
});

export default Item;