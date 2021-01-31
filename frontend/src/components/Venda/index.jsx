import React from 'react';
import Row from '../Row';
import Item from './Item';
import { Wrapper } from './styles';
import moment from 'moment-business-days';

const Venda = React.forwardRef(({ venda }, ref) => {

    const entregaPrevista = () => {
        return moment(venda.momento, 'DD/MM/YYYY').businessAdd(venda.entrega_prevista).format('DD/MM/YYYY');
    }

    return (
        <Wrapper width="100%" direction="column">
            <Row width="100%" justify="space-between" className="data">
                <div className="data-item">Venda: {venda.id}</div>
                <div className="data-item">Momento: {venda.momento}</div>
                <div className="data-item">Entrega Prevista: {entregaPrevista()}</div>
                <div className="data-item">Total: R$ {venda.subtotal}</div>
            </Row>

            <Row width="100%" direction="column" className="items">
                {
                    venda.items.map(i => <Item key={`venda_item${venda.id}_${i.produto.id}`} item={i} />)
                }
            </Row>
        </Wrapper>
    );
});

export default Venda;