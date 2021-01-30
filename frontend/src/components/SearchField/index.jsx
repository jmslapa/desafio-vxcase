import React from 'react';
import { Search } from 'styled-icons/fa-solid';
import { Wrapper } from './styles';

const SearchField = React.forwardRef(({ width, ...rest }, ref) => {
    return (
        <Wrapper width={width}>
            <input {...rest} ref={ref} type="text" placeholder="Buscar..."/>
            <Search size={20}/>
        </Wrapper>
    )
});

export default SearchField;