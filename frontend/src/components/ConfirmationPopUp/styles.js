import styled from 'styled-components';
import { fadeIn } from '../../styles/keyframes';
import { floatContainer, theme } from '../../styles/styleGuide';

export const PopUp = styled.div`
    ${floatContainer};
    padding: 30px;
    margin: 50px;

    .message {
        ${theme};
        text-align: center;
        font-size: 16px;
        font-weight: 600;
        color: var(--dark);
    }
    
    .ctas {
        display:flex;
        justify-content: center;

        button {            
            display:flex;
            justify-content: center;
            align-items: center;
            margin: 20px 20px 0 20px;
            font-weight: 600;
            font-size: 18px;

            > svg {
                pointer-events: none;
                margin-left: 10px;
            }

            &.confirm {
                ${theme};
                color: var(--secondary);
            }

            &.decline {
                ${theme};
                color: var(--light-darker);
            }
        }
    }
`;

export const Wrapper = styled.div`
    display: flex;
    direction: column;
    justify-content: center;
    align-items: center;
    position: ${props => props.position || 'relative'};
    background: ${props => props.background || 'transparent'};
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    animation: ${fadeIn} 0.2s linear;
`;