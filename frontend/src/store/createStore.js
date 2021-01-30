import { createStore as reduxCreateStore, compose, applyMiddleware } from 'redux';

const createStore = (reducers, middlewares) => {

  const composeEnhancers =
  typeof window === 'object' &&
    window.__REDUX_DEVTOOLS_EXTENSION_COMPOSE__ ?   
    window.__REDUX_DEVTOOLS_EXTENSION_COMPOSE__({}) : compose;


  const enhancer =
    process.env.NODE_ENV === 'development'
      ? composeEnhancers(applyMiddleware(...middlewares))
      : compose(applyMiddleware(...middlewares));

  return reduxCreateStore(reducers, enhancer);
};

export default createStore;
