import { css } from 'styled-components';
import * as Utils from './utils';

const colors = {
    primary: '#1266F1',
    secondary: '#B23CFD',
    success: '#00B74A',
    danger: '#F93154',
    light: '#FBFBFB',
    dark: '#262626',
}

export const theme = css`

    --primary: ${colors.primary};
    --primary-darker: ${() => Utils.colorLuminosity(colors.primary, -50)};
    --primary-lighter: ${() => Utils.colorLuminosity(colors.primary, 50)};
    --primary-hover-highlight: ${() => Utils.hexToRgba(colors.primary, 0.15)};

    --secondary: ${colors.secondary};
    --secondary-darker: ${() => Utils.colorLuminosity(colors.secondary, -50)};
    --secondary-lighter: ${() => Utils.colorLuminosity(colors.secondary, 50)};
    --secondary-hover-highlight: ${() => Utils.hexToRgba(colors.secondary, 0.15)};

    --success: ${colors.success};
    --success-darker: ${() => Utils.colorLuminosity(colors.success, -50)};
    --success-lighter: ${() => Utils.colorLuminosity(colors.success, 50)};
    --success-hover-highlight: ${() => Utils.hexToRgba(colors.success, 0.15)};

    --danger: ${colors.danger};
    --danger-darker: ${() => Utils.colorLuminosity(colors.danger, -50)};
    --danger-lighter: ${() => Utils.colorLuminosity(colors.danger, 50)};
    --danger-hover-highlight: ${() => Utils.hexToRgba(colors.danger, 0.15)};

    --light: ${colors.light};
    --light-darker: ${() => Utils.colorLuminosity(colors.light, -50)};
    --light-lighter: ${() => Utils.colorLuminosity(colors.light, 50)};
    --light-hover-highlight: ${() => Utils.hexToRgba(colors.light, 0.15)};

    --dark: ${colors.dark};
    --dark-lighter: ${() => Utils.colorLuminosity(colors.dark, 50)};
    --dark-hover-highlight: ${() => Utils.hexToRgba(colors.dark, 0.15)};
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