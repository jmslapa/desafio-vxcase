import styled from 'styled-components';
import { theme } from '../../styles/styleGuide';
import { fadeIn } from '../../styles/keyframes';

export const Wrapper = styled.div`
    ${theme};
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 38px;
    width: ${props => props.width || 'auto'};
    height: 38px;
    padding: 0 10px;
    background: var(--light);
    border-radius: 8px;
    animation: ${fadeIn} 0.2s linear;

    > svg {
        ${theme}
        pointer-events: none;
        color: var(--secondary);
        
        + input[type="text"] {
            margin-left: 10px;
        }
    }

    > input[type="text"] {
        ${theme}
        width: calc(100%);
        border: none;
        background: transparent;
        font-weight: 600;
        color: var(--secondary);

        ::placeholder {            
            ${theme}
            color: var(--secondary-lighter);
        }

        + svg {
            margin-left: 10px;
        }
    }
`;