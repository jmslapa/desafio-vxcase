import history from './history'
import {toast} from 'react-toastify'

const defaultMessage = "Não foi possível completar a operação.";

export default function handle(error, message = defaultMessage) {
    if(process.env.NODE_ENV === 'development') {
        error.response ? console.log(error.response) : console.log(error);
    } 
    if(error.response) {
        switch(error.response.status) {
            case 400:
                toast.error(error.response.data.message);
                break;
            case 401:
                history.push('/');
                break;
            case 422:
                if(message !== defaultMessage) {
                    toast.error(message);
                } else {            
                    if(error.response.data.errors) {
                        Object.values(error.response.data.errors).forEach(
                            errorGroup => errorGroup.forEach(e => toast.error(e)
                        ));
                    } else {
                        toast.error(error.response.data.message);
                    }    
                }   
                break;
            case 500:
                toast.error(error.response.data.message)
                break;
            default:
                toast.error(message);
                break;
        }
    } else {
        toast.error(message);
    }
}