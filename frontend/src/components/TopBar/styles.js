import styled from 'styled-components';
import { fadeIn } from '../../styles/keyframes';
import { theme } from '../../styles/styleGuide';

export const Wrapper = styled.div`
    ${theme};
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 15px;
    width: 100%;
    border-radius: 8px;
    background: var(--secondary);
    color: var(--light);
    transition: max-height 0.4s;

    .nav {  
        display: flex;
        justify-content: center;
        align-items: center;
        .separator {
            ${theme}; 
            width: 2px;
            height: 20px;
            margin: 0 10px;   
            background: var(--light);
        }

        .nav-link {
            ${theme};        
            color: var(--light);
        }
    }

    .collapse {
        width: 100%;        
        max-height: 0;
        opacity: 0;
        overflow:hidden;
        transition: opacity 0.4s, 0.2s;

        :focus-within {        
            margin-top: 10px;
            max-height: 38px;
            opacity: 1;
        }
    }

    button.collapse-toggle {
        ${theme};        
        color: var(--light);
        animation: ${fadeIn} 0.2s linear;
    }
`;