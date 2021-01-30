import { createGlobalStyle } from 'styled-components';

import 'react-toastify/dist/ReactToastify.css';
export default createGlobalStyle`
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap');

  * {
    margin: 0;
    padding: 0;
    outline: 0;
    box-sizing: border-box; /* os espaçamentos são somados ao elemento */
  }

  *:focus {
    outline: 0
  }

  html {
    font-size: 62.5%;
  }

  html, body, #root {
    height: 100%;
  }

  body {
    -webkit-font-smoothing: antialiased !important; /* as fontes ficam mais definidas nas bordas */
  }

  body {
    overflow: hidden;
  }

  body, input, button {
    font: 1.4rem 'Montserrat', sans-serif;
  }

  a {
    text-decoration: none;
  }

  ul {
    list-style: none;
  }

  button {
    cursor: pointer;
    border: 0;
    background: none;
  }

  input:disabled {
    cursor: not-allowed;
    opacity: 0.5;
  }

  /* Helpers */

  .is-marginless {
    margin: 0!important;
  }

  .is-paddingless {
    padding: 0!important;
  }

  .has-text-centered {
    text-align: center;
  }

  /* Scroll  */

  ::-webkit-scrollbar {
    width: 10px;
  }

  .disable-scrollbar::-webkit-scrollbar {
    width: 0px;
  }

  ::-webkit-scrollbar-track {
    box-shadow: inset 0 0 1px rgba(0, 0, 0, 0.3);
  }

  ::-webkit-scrollbar-thumb {
    background-color: #f5f5f5;
    outline: 1px solid #f5f5f5;
  }

  .svg-circle-text {
    font-weight: 500;
    font-size: 1.3rem;
    fill: #a459b2;
    text-anchor: middle;
  }
`;
