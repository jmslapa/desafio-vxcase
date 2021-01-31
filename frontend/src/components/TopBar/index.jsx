import React, { useEffect, useRef, useState } from 'react';
import { Wrapper } from './styles';
import { Bars } from 'styled-icons/fa-solid';
import Cart from '../Cart';
import If, { Else } from '../Utils/If';
import SearchField from '../SearchField';
import Row from '../Row';
import history from '../../services/history';

const TopBar = ({ title }) => {

    const [vw, setVw] = useState(Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0), []);

    const collapsibleSearchInput = useRef(null);

    useEffect(() => {
        window.addEventListener('resize', e => {
            setVw(Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0), [])
        });
    }, []);

    return(
        <Wrapper>
            <Row width="100%" height="100%" direction="column">
                <Row width="100%" justify="space-between" align="center">
                    <div className="nav">
                        <button type="button" className="nav-link" onClick={e => history.push('/produtos')}>
                            <h2>Produtos</h2>                        
                        </button>

                        <div className="separator"></div>

                        <button type="button" className="nav-link" onClick={e => history.push('/vendas')}>
                            <h2>Vendas</h2>                        
                        </button>
                    </div>
                    <Row width={vw >= 600 ? '284px' : '75px'} justify="space-between" align="center">
                        <If condition={vw >= 600}>                    
                            <SearchField />
                            <Else>
                                <button type="button" className="collapse-toggle" onClick={() => collapsibleSearchInput.current.focus()}>
                                    <Bars size={30}/>
                                </button>
                            </Else>
                        </If>
                        <Cart />
                    </Row>
                </Row>

                <If condition={vw < 600}>                    
                    <div className="collapse">
                        <SearchField ref={collapsibleSearchInput}/>
                    </div>
                </If>
            </Row>
        </Wrapper>
    );
}

export default TopBar;