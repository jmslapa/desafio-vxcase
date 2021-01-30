import React, { useEffect, useState } from 'react';
import Card from '../../components/Card';
import Row from '../../components/Row';
import Spinner from '../../components/Spinner';
import If from '../../components/Utils/If';
import api from '../../services/api';
import errorHandler from '../../services/errorHandler';

const Lista = (props) => {

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
                <Spinner position="absolute" background="#ffffff">
                    <div className="loader"></div>
                </Spinner>
            </If>
            <Row height="100%" margin="20px 0" wrap="wrap" justify={'space-around'} 
                overflowY="scroll" overflowX="hidden" noScrollbar
            >
                {produtos.map(p => <Card produto={p}/>)}
            </Row>
         </>
    );
}

export default Lista;