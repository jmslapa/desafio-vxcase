import styled from 'styled-components';

const Row = styled.div`
    display: flex;
    flex-wrap: ${props => props.wrap || 'no-wrap'};
    flex-direction: ${props => props.direction || 'row'};
    width: ${props => props.width || 'auto'};
    height: ${props => props.height || 'auto'};
    justify-content: ${props => props.justify || 'flex-start'};
    align-items: ${props => props.align || 'flex-start'};
    margin: ${props => props.margin || '0'};
    padding: ${props => props.padding || '0'};
`;

export default Row;
