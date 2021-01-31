import React, { useRef, useState } from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { Handshake, ShoppingCart, TimesCircle } from 'styled-icons/fa-solid';
import { emptyCart, removeProductFromCart } from '../../store/modules/cart/actions';
import Row from '../Row';
import If, { Else } from '../Utils/If';
import { CartMenu, CartPopOver, Wrapper } from './styles';
import moment from 'moment-business-days';
import { toast } from 'react-toastify';
import Spinner from '../Spinner';
import api from '../../services/api';
import errorHandler from '../../services/errorHandler';
import ConfirmationPopUp from '../ConfirmationPopUp';

const Cart = React.forwardRef((props, ref) => {

    const cart = useSelector(state => state.cart);
    const dispatch = useDispatch();

    const cartButton = useRef(null);

    const [confirming, setConfirming] = useState(false);
    const [concluding, setConcluding] = useState(false);

    const handleRemove = (item) => {
        cartButton.current.focus();
        dispatch(removeProductFromCart(item));
    }

    const subtotal = () => {
        return cart.items.reduce((acc, curr) => {
            let preco = parseFloat(curr.preco.replace(',', '.'));
            return acc + preco;
        }, 0.00).toFixed(2);
    }

    const dataPrevista = () => {
        let max = cart.items.map(i => i.entrega).sort((a, b) => a - b).reverse()[0];
        return moment().businessAdd(max).format('DD/MM/YYYY');
    }

    const onDecline = () => {
        cartButton.current.focus();
        setConfirming(false);
    }

    const onConfirm = () => {
        cartButton.current.focus();
        setConfirming(false);
        setConcluding(true);
        api.post('vendas', { produtos: cart.items.map(i => i.id) })
        .then(() => dispatch(emptyCart()))
        .then(() => toast.success('Compra realizada com sucesso!'))
        .catch(err => errorHandler(err))
        .then(() => setConcluding(false));
    }

    const Item = ({item}) => {
        return (
            <li className="item">
                <Row width="100%" justify="space-between" align="center">
                    <div>
                        <div className="item-name">{item.nome}</div>
                        <Row className="metadata-container" margin="8px 0 0 0">
                            <div className="metadata">Preço: R$ {item.preco}</div>
                            <div className="metadata">Entrega prevista: {item.entrega} dias úteis</div>
                        </Row>
                    </div>
                    <div className="thumb-container">
                        <img src={item.capa} alt="img_produto" className="item-thumb"/>
                        <button className="remove" onClick={() => handleRemove(item)}>
                            <TimesCircle size={20} />
                        </button>
                    </div>
                </Row>
            </li>
        );
    }

    return (
        <Wrapper>
            <button type="button" ref={cartButton}>
                <ShoppingCart size={30}/>
                <If condition={cart.items.length}>
                    <div className="badge">{cart.items.length}</div>
                </If>
            </button>          
            <CartPopOver>
                <CartMenu>
                    <div className="title">Carrinho de compras</div>
                    <div className="item-list">
                        <div className="list-title">Seus produtos:</div>
                        <ul className="list">
                            <If condition={cart.items.length}>
                                { cart.items.map(i => <Item key={`cart_item_${i.id}`} item={i}/>) }
                                <Else>
                                    <li className="no-content">Nenhum item no carrinho</li>
                                </Else>
                            </If>
                        </ul>
                    </div>
                    <If condition={cart.items.length}>                        
                        <div className="summary">
                            <div className="metadata">Entrega Prevista: {dataPrevista()}</div>
                            <div className="metadata">Subtotal: R$ {subtotal().replace('.', ',')}</div>
                        </div>

                        <div className="footer">
                            <button type="button" className="finish" onClick={e => setConfirming(true)}>
                                Finalizar compra
                                <Handshake size={50}/>
                            </button>
                        </div>                  
                    </If>
                    <If condition={confirming}>
                        <ConfirmationPopUp 
                            position="absolute"
                            background="rgba(255,255,255,0.9)"
                            message="Já conferiu tudo? Podemos concluir a sua compra?"
                            onDecline={onDecline}
                            onConfirm={onConfirm}
                        />
                    </If>
                    <If condition={concluding}>
                        <Spinner position="absolute" background="rgba(255,255,255,0.9)" scale="0.8">
                            <div className="loader"></div>
                        </Spinner>
                    </If>
                </CartMenu>
            </CartPopOver>
        </Wrapper>
    );
});

export default Cart;