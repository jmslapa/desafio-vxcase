import produce from 'immer';

const INITIAL_STATE = {
  value: '',
};

export default function search(state = INITIAL_STATE, {type, payload}) {
  return produce(state, draft => {
    switch (type) {

      case '@search/CHANGE':
        draft.value = payload.value;
      break;

      default:
        draft = INITIAL_STATE;
    }
  });
}
