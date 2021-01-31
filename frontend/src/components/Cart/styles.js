import styled from 'styled-components';

import { floatContainer, hiddenScrollBar, theme } from '../../styles/styleGuide';

export const CartMenu =styled.div`
    position: relative;
    padding: 10px 0;
    width: 400px;

    .title {
        padding: 0 10px;
        ${theme};
        font-weight: 600;
        font-size: 24px;
        color: var(--secondary-darker); 
    }

    div.item-list {
        margin-top: 10px;
        padding: 0 10px;

        .list-title {
            ${theme};
            font-weight: 600;
            font-size: 16px;
            color: var(--dark-lighter); 
        }

        ul.list {
            max-height: 222px;
            overflow-x: hidden;
            overflow-y: scroll;
            ${hiddenScrollBar};

            li.no-content {
                ${theme}
                width: 100%;
                text-align: center;
                font-weight: 600;
                font-size: 15px;  
                color: var(--light-darker); 
                margin: 15px auto;
            }

            li.item {
                ${theme}
                padding: 10px;

                .item-name {     
                    ${theme}
                    display:block; 
                    font-weight: 600;
                    font-size: 14px;  
                    min-height: 32px;
                    color: var(--secondary-lighter); 
                    width: 257px;   
                }

                .metadata-container {
                    ${theme}
                    display:block; 
                    font-weight: 500;
                    font-size: 14px;  
                    min-height: 32px;
                    color: var(--dark-lighter); 
                }

                .thumb-container {
                    position: relative;
                    .item-thumb {
                        ${theme}
                        width: 88px;
                        height: 88px;
                        border: 1px solid var(--secondary);
                        padding: 2px;
                        border-radius: 50%;
                    }
                    > button.remove {
                        ${theme}
                        position: absolute;
                        top: -5px;
                        right: -5px;
                        background: #fff;
                        color: var(--danger-darker);
                        border-radius: 50%;
                    }
                }
            }
        }        
    }

    .summary {  
        
        ${theme};
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin-top: 10px;
        padding: 10px 0;
        background: var(--light-darker);
        color: var(--dark-lighter);
        font-weight: 600;
        font-size: 16px;   

        .metadata {            
            margin-top: 5px;

            :first-child {
                margin: 0;
            }
        }
    }

    .footer {
        ${theme};
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin-top: 10px;
        padding: 10px 10px 0 10px;
        border-top: 1px solid var(--light-darker);
        
        button.finish {
            ${theme};
            color: var(--secondary-darker);
            font-weight: 600;
            font-size: 20px;

            svg {
                pointer-events: none;
                margin-left: 10px;
            }
        }
    }
`;

export const CartPopOver = styled.div`
    position: absolute;
    top: 50px;
    right: -15px;
    border-radius: 8px;
    max-width: 0;
    opacity: 0;
    overflow-x: hidden;
    overflow-y: scroll;
`;

export const Wrapper = styled.div`      
    ${theme};
    position: relative;
    color: var(--dark);
    z-index: 1;

    :focus-within {
        ${CartPopOver} {            
            ${floatContainer};
            ${hiddenScrollBar};
            max-width: 400px;
            opacity: 1;
            transition: max-width 0.2s, opacity 0.4s;
        }
    }

    > button {       
        position: relative; 
        ${theme};        
        color: var(--light);

        div.badge {
            ${theme};
            position: absolute;
            top: -5px;
            right: -10px;
            width: 16px;
            height: 16px;
            background: var(--danger);   
            border-radius: 50%;         
        }
    }
`;