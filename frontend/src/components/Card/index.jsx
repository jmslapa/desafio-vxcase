import React from 'react';
import { useSelector, useDispatch } from 'react-redux';
import { Wrapper } from './styles';
import Spinner from '../Spinner';
import { CartArrowDown, CartPlus } from 'styled-icons/fa-solid';
import If, { Else } from '../Utils/If';
import { addProductToCart, removeProductFromCart } from '../../store/modules/cart/actions'

const Card = React.forwardRef(({ produto }, ref) => {

    const cart = useSelector(state => state.cart);
    const dispatch = useDispatch();

    const onCart = (p) => {
        return cart.items.map(item => item.id).includes(p.id);
    }

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
                <If condition={onCart(produto)}>
                    <button type="button" className="remove" onClick={e => dispatch(removeProductFromCart(produto))}>
                        Remover do carrinho
                        <CartArrowDown size={20}/>
                    </button>
                    <Else>                        
                        <button type="button" className="add" onClick={e => dispatch(addProductToCart(produto))}>
                            Adicionar ao carrinho
                            <CartPlus size={20}/>
                        </button>
                    </Else>
                </If>
            </div>
        </Wrapper>
    );
});

export default Card;