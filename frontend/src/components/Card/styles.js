import styled from 'styled-components';
import { floatContainer, theme } from '../../styles/styleGuide';

export const Wrapper = styled.div`
    ${floatContainer};
    margin: 20px 10px;
    padding: 10px 0px;
    border-radius: 8px;

    .title, .price, footer {
        padding: 0 10px;
    } 

    .image {
        position: relative;
        ${theme}
        width: 192px;
        height: 192px;
        margin: 0 10px;
        background: var(--light);

        > img {
            position:absolute;
            top: 0;
            left: 0;
            width: 100%;
        }
    }

    .title {
        ${theme};
        margin-top: 10px;
        width: 192px;
        height: 54px;
        font-weight: 600;
        font-size: 15px;
        color: var(--dark-lighter);

    }

    .price {
        ${theme};
        margin-top: 10px;
        width: 192px;
        line-height: 20px;
        font-weight: 900;
        font-size: 19px;
        color: var(--secondary-darker);
        text-align: right;
    }

    .footer {
        ${theme};
        display:flex;
        align-items: center;
        justify-content: center;
        border-top: 1px solid var(--light-darker);
        margin-top: 10px;
        padding-top: 10px;

        > button {
            ${theme};
            font-weight: 600;
            color: var(--danger-lighter);
            transition: 0.05s;

            :hover {
                ${theme};
                transform: scale(1.15);
                color: var(--danger);
            }

            svg {
                pointer-events: none;
                margin-left: 10px;
            }
        }
    }

`;