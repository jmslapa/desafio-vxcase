import React from 'react';
import { Wrapper } from './styles';
import Spinner from '../Spinner';
import { CartPlus } from 'styled-icons/fa-solid';

const Card = React.forwardRef(({ produto }, ref) => {
    return (
        <Wrapper>
            <div className="image">
                <Spinner position="absolute" scale="0.7">
                    <div className="loader"></div>
                </Spinner>
                <img src={produto.capa} alt={`capa_produto_${produto.id}`}/>
            </div>
            <div className="title">{ produto.nome }</div>
            <div className="price">R$ {produto.preco}</div>
            <div className="footer">
                <button type="button">
                    Adicionar ao carrinho
                    <CartPlus size={20}/>
                </button>
            </div>
        </Wrapper>
    );
});

export default Card;