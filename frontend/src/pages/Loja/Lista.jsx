import React, { useEffect, useState } from 'react';
import { useSelector } from 'react-redux';
import Card from '../../components/Card';
import Row from '../../components/Row';
import Spinner from '../../components/Spinner';
import If from '../../components/Utils/If';
import api from '../../services/api';
import errorHandler from '../../services/errorHandler';

const Lista = (props) => {

    const search = useSelector(state => state.search)

    const [loading, setLoading] = useState(false);
    const [produtos, setProdutos] = useState([]);

    useEffect(() => {
        setLoading(true);
        api.get('produtos')
        .then(resp => setProdutos(resp.data.data))
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
            <Row height="100%" width="100%" margin="20px 0" wrap="wrap" justify={'space-around'} 
                overflowY="scroll" overflowX="hidden" noScrollbar
            >
                {
                    produtos.filter(p => {
                        return p.nome.toLowerCase().includes(search.value.trim().toLowerCase()) 
                            || p.slug.includes(search.value.trim().toLowerCase());
                    }).map(p => <Card key={`produto_${p.id}`} produto={p}/>)
                }
            </Row>
         </>
    );
}

export default Lista;