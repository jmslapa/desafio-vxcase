import styled from 'styled-components';
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
`;