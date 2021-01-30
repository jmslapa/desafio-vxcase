import styled from 'styled-components';
import { fadeIn } from '../../styles/keyframes';
import { theme } from '../../styles/styleGuide';

export const Wrapper = styled.div`
    ${theme};
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: sticky;
    top: 40px;
    left: 0px;
    padding: 10px 15px;
    width: 100%;
    border-radius: 8px;
    background: var(--secondary);
    color: var(--light);
    transition: max-height 0.4s;

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