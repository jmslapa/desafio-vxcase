import styled, { css } from 'styled-components';
import env from './envConfs';
import * as Utils from './utils';

export const theme = css`
--cta: ${() => '#26AAEC'};
--cta-darker: ${() => Utils.colorLuminosity('#26AAEC', -50)};
--cta-lighter: ${() => Utils.colorLuminosity('#26AAEC', 50)};
--hover-highlight: ${() => Utils.hexToRgba('#26AAEC', 0.15)};
--success: #45DC67;
--danger: #DF4742;
`;

export const hiddenScrollBar = css`    
    -ms-overflow-style: none;
    scrollbar-width: 0px;

    ::-webkit-scrollbar {
        display: none;
    }
`;

export const errorMessage = css`    
    font-size: 12px;
    color: #f64c75;
`;
export const dropContainer = css`
    background: #FCFCFC;
    border: 1.5px solid rgba(196, 196, 196, 0.15);
    box-sizing: border-box;
    box-shadow: 3px 3px 5px rgba(0, 0, 0, 0.15);
    border-radius: 15px;
`;