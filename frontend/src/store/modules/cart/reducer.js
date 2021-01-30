import produce from 'immer';

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
        draft.items = draft.items.filter(p => p.id !== payload.targetId);
      break;

      default:
        draft = INITIAL_STATE;
    }
  });
}
