import React from 'react';
import { Wrapper } from './styles';
import { ShoppingCart } from 'styled-icons/fa-solid';
import SearchField from '../SearchField';
import Row from '../Row';

const TopBar = (props) => {

    return(
        <Wrapper>
            <h1>Produtos</h1>
            <Row width="284px" justify="space-between" align="center">
                <SearchField />
                <ShoppingCart size={30}/>
            </Row>
        </Wrapper>
    );
}

export default TopBar;