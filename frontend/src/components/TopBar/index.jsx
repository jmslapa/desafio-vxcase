import React, { useCallback, useEffect, useRef, useState } from 'react';
import { Wrapper } from './styles';
import { Bars, ShoppingCart } from 'styled-icons/fa-solid';
import If, { Else } from '../Utils/If';
import SearchField from '../SearchField';
import Row from '../Row';

const TopBar = ({ title }) => {

    const getVw = useCallback(() => Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0), []);

    const [vw, setVw] = useState(getVw());

    const collapsibleSearchInput = useRef(null);

    useEffect(() => {
        window.addEventListener('resize', e => {
            setVw(getVw);
        });
    }, []);

    return(
        <Wrapper>
            <Row width="100%" height="100%" direction="column">
                <Row width="100%" justify="space-between">
                    <h1>{ title }</h1>
                    <Row width={vw >= 600 ? '284px' : '75px'} justify="space-between" align="center">
                        <If condition={vw >= 600}>                    
                            <SearchField />
                            <Else>
                                <button type="button" className="collapse-toggle" onClick={() => collapsibleSearchInput.current.focus()}>
                                    <Bars size={30}/>
                                </button>
                            </Else>
                        </If>
                        <ShoppingCart size={30}/>
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