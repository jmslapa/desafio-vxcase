import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { Search } from 'styled-icons/fa-solid';
import { changeSearchValue } from '../../store/modules/search/actions';
import { Wrapper } from './styles';

const SearchField = React.forwardRef(({ width, ...rest }, ref) => {

    const search = useSelector(state => state.search);
    const dispatch = useDispatch();

    return (
        <Wrapper width={width}>
            <input {...rest} ref={ref} type="text" placeholder="Buscar..."
                value={search.value} onChange={e => dispatch(changeSearchValue(e.target.value))}
            />
            <Search size={20}/>
        </Wrapper>
    )
});

export default SearchField;