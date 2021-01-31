import produce from 'immer';
import { toast } from 'react-toastify';

const INITIAL_STATE = {
  items: [],
};

export default function cart(state = INITIAL_STATE, {type, payload}) {
  return produce(state, draft => {
    switch (type) {

      case '@cart/ADD_PRODUCT':
        draft.items.push(payload.product);
      break;

      case '@cart/REMOVE_PRODUCT':
        draft.items = draft.items.filter(p => p.id !== payload.product.id);
      break;

      case '@cart/EMPTY':
        draft.items = [];
      break;

      default:
        draft = INITIAL_STATE;
    }
  });
}
