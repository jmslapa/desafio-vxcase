import { combineReducers } from 'redux';

import cart from './cart/reducer';
import search from './search/reducer'

export default combineReducers({
  cart, search
});
