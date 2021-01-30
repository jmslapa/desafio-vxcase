import produce from 'immer';

const INITIAL_STATE = {
  token: null,
  tokenType: null,
  signed: false,
  isMaster: false,
  loading: false,
};

export default function auth(state = INITIAL_STATE, action) {
  return produce(state, draft => {
    switch (action.type) {
      case '@auth/SIGN_IN_REQUEST': {
        draft.loading = true;
        break;
      }
      case '@auth/SIGN_IN_SUCCESS': {
        draft.token = action.payload.token.access_token;
        draft.tokenType = action.payload.token.token_type;
        draft.signed = true;
        draft.isMaster = action.payload.isMaster;
        draft.loading = false;
        break;
      }
      case '@auth/SIGN_IN_FAILURE': {
        draft.loading = false;
        break;
      }
      case '@auth/SIGN_OUT_SUCCESS': {
        draft.token = null;
        draft.tokenType = null;
        draft.signed = false;
        draft.isMaster = false;
        draft.loading = false;
        break;
      }
      default:
    }
  });
}
