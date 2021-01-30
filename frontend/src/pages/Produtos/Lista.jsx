import React, { useEffect, useState } from 'react';
import Card from '../../components/Card';
import Row from '../../components/Row';

const Lista = (props) => {
    
    const produto = {
        id: 137,
        nome: 'Nom do produto com 50 caracteres de tamanho máximo',
        preco: '3658,56',
        capa: 'https://source.unsplash.com/random/512x512',
    }

    const [vw, setVw] = useState(Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0), []);

    useEffect(() => {
        window.addEventListener('resize', e => {
            setVw(Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0), [])
        });
    }, []);

    return (       
         
        <Row height="100%" margin="20px 0" wrap="wrap" justify={'space-around'} 
            overflowY="scroll" overflowX="hidden" noScrollbar
        >
            {Array(18).fill(undefined).map((e, index) => <Card produto={produto} key={index}/>)}
        </Row>
    );
}

export default Lista;