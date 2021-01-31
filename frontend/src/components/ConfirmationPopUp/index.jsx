import React from 'react';
import { Check, Times } from 'styled-icons/fa-solid';
import { PopUp, Wrapper } from './styles';

const ConfirmationPopUp = ({ message, onConfirm, onDecline, ...rest }) => {

    return (
        <Wrapper {...rest}>
            <PopUp>
                <div className="message">{ message }</div>
                <div className="ctas">
                    <button className="decline" onClick={e => onDecline()}>
                        Não 
                        <Times size={25}/>
                    </button>
                    <button className="confirm" onClick={e => onConfirm()}>
                        Sim
                        <Check size={25}/>
                    </button>
                </div>
            </PopUp>
        </Wrapper>
    );
}

export default ConfirmationPopUp;