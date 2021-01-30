import styled from 'styled-components'
import { theme } from '../../styles/styleGuide';

export const Spinner = styled.div`
  position: ${props => props.position || 'relative'};
  top: 0px;
  left: 0px;
  display: flex;
  height: 100%;
  width: 100%;
  justify-content: center;
  align-items: center;
  background: ${props => props.background || 'transparent'};
  transform: ${props => `scale(${props.scale || '1'})`};
  background: ${props => props.background || 'transparend'};

  .loader,
  .loader:before,
  .loader:after {
    border-radius: 50%;
    width: 2.5em;
    height: 2.5em;
    -webkit-animation-fill-mode: both;
    animation-fill-mode: both;
    -webkit-animation: load7 1.8s infinite ease-in-out;
    animation: load7 1.8s infinite ease-in-out;
  }
  .loader {
    ${theme}
    color: var(--secondary);
    font-size: 10px;
    position: relative;
    top: -25px;
    -webkit-animation-delay: -0.16s;
    animation-delay: -0.16s;
  }
  .loader:before,
  .loader:after {
    content: '';
    position: absolute;
  }
  .loader:before {
    left: -3.5em;
    -webkit-animation-delay: -0.32s;
    animation-delay: -0.32s;
  }
  .loader:after {
    left: 3.5em;
  }
  @-webkit-keyframes load7 {
    0%,
    80%,
    100% {
      box-shadow: 0 2.5em 0 -1.3em;
    }
    40% {
      box-shadow: 0 2.5em 0 0;
    }
  }
  @keyframes load7 {
    0%,
    80%,
    100% {
      box-shadow: 0 2.5em 0 -1.3em;
    }
    40% {
      box-shadow: 0 2.5em 0 0;
    }
  }

`;

export default Spinner;