import storage from 'redux-persist/lib/storage';
import { persistReducer } from 'redux-persist';

const persistReducers = (reducers) => {
  const persistedReducer = persistReducer(
    {
      key: 'vxcase',
      storage,
      whitelist: ['cart'],
    },
    reducers
  );

  return persistedReducer;
};

export default persistReducers;