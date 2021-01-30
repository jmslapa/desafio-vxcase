import React from 'react';
import Container from '../../components/Container';
import TopBar from '../../components/TopBar';
import Lista from './Lista';

const Produtos = (props) => {
    return (
        <Container>
            <TopBar title="Produtos"/>
            <Lista />
        </Container>
    );
}

export default Produtos;