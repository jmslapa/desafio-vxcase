import styled from 'styled-components';
import { floatContainer, theme } from '../../styles/styleGuide';
import Row from '../Row';

export const Wrapper = styled(Row)`
    ${theme};
    padding: 10px;
    margin: 10px 0;
    width: 95%;
    ${floatContainer};

    .data {
        ${theme};
        font-size: 16px;
        font-weight: 600;
        color: var(--dark);
        padding-bottom: 5px;
        border-bottom: 2px solid var(--dark);
    }

    .items {
        .item{
            margin-top: 10px;

            .capa {
                width: 64px;
                height: 64px;
                border-radius: 50%;
                margin-right: 15px;
            }
            .nome, .valor {
                ${theme};
                font-size: 14px;
                font-weight: 600;
                color: var(--dark-lighter);
            }
            
            .separator {
                ${theme};
                flex-grow: 1;
                margin: 20px;
                border-top: 2px dotted var(--light-darker);
            }
        }
    }
`;