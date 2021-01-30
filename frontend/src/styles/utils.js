import styled, { css } from 'styled-components';

export const colorLuminosity = (color, amt) => {
  
    let useHash = false;
  
    if (color[0] == "#") {
        color = color.slice(1);
        useHash = true;
    }
 
    let num = parseInt(color,16);
 
    let r = (num >> 16) + amt;
 
    if (r > 255) r = 255;
    else if  (r < 0) r = 0;
 
    let b = ((num >> 8) & 0x00FF) + amt;
 
    if (b > 255) b = 255;
    else if  (b < 0) b = 0;
 
    let g = (num & 0x0000FF) + amt;
 
    if (g > 255) g = 255;
    else if (g < 0) g = 0;
 
    return (useHash ? "#" : "") + (g | (b << 8) | (r << 16)).toString(16);
  
}

export const hexToRgba = (color, opacity) => {
    let hex = color.replace('#', '');
    
    if (hex.length === 3) {
        hex = `${hex[0]}${hex[0]}${hex[1]}${hex[1]}${hex[2]}${hex[2]}`;
    }    
    
    const r = parseInt(hex.substring(0, 2), 16);
    const g = parseInt(hex.substring(2, 4), 16);
    const b = parseInt(hex.substring(4, 6), 16);

    return `rgba(${r},${g},${b},${opacity})`;
}