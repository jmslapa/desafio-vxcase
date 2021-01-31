import React, { useEffect, useState } from 'react';
import { useSelector } from 'react-redux';
import Row from '../../components/Row';
import Spinner from '../../components/Spinner';
import If from '../../components/Utils/If';
import Venda from '../../components/Venda';
import api from '../../services/api';
import errorHandler from '../../services/errorHandler';

const Lista = (props) => {

    const search = useSelector(state => state.search)

    const [loading, setLoading] = useState(false);
    const [vendas, setVendas] = useState([]);

    useEffect(() => {
        setLoading(true);
        api.get('vendas')
        .then(resp => setVendas(resp.data.data))
        .catch(err => errorHandler(err))
        .then(() => setLoading(false));
    }, [])

    return (       
         <>
            <If condition={loading}>
                <Spinner position="fixed" background="#ffffff" zIndex={2}>
                    <div className="loader"></div>
                </Spinner>
            </If>
            <Row height="100%" width="100%" margin="20px 0" direction="column" align="center"
                overflowY="scroll" overflowX="hidden" noScrollbar
            >
                {
                    vendas.filter(v => {

                        let searchValue = search.value.trim().toLowerCase();
                        let names = v.items.map(item => item.produto.nome.toLowerCase());
                        let slugs = v.items.map(item => item.produto.slug)
                        
                        let namesIncludes = names.reduce((acc, curr) => {
                            if(curr.includes(searchValue)) {
                                acc = true;
                            }
                            return acc;
                        }, false);

                        let slugsIncludes = slugs.reduce((acc, curr) => {
                            if(curr.includes(searchValue)) {
                                acc = true;
                            }
                            return acc;
                        }, false);

                        return namesIncludes || slugsIncludes;

                    }).map(v => <Venda key={`venda_${v.id}`} venda={v}/>)
                }
            </Row>
         </>
    );
}

export default Lista;