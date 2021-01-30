import React from 'react';
import { Wrapper } from './styles';
import { ShoppingCart } from 'styled-icons/fa-solid';
import SearchField from '../SearchField';
import Row from '../Row';

const TopBar = ({ title }) => {

    return(
        <Wrapper>
            <h1>{ title }</h1>
            <Row width="284px" justify="space-between" align="center">
                <SearchField />
                <ShoppingCart size={30}/>
            </Row>
        </Wrapper>
    );
}

export default TopBar;