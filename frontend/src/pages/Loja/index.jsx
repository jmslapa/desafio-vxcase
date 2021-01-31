import React from 'react';
import Container from '../../components/Container';
import TopBar from '../../components/TopBar';
import Lista from './Lista';

const Loja = (props) => {
    return (
        <Container>
            <TopBar/>
            <Lista />
        </Container>
    );
}

export default Loja;