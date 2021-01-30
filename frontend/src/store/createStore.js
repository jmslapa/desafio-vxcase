import { createStore, compose, applyMiddleware } from 'redux';

export default (reducers, middlewares) => {

  const composeEnhancers =
  typeof window === 'object' &&
    window.__REDUX_DEVTOOLS_EXTENSION_COMPOSE__ ?   
    window.__REDUX_DEVTOOLS_EXTENSION_COMPOSE__({}) : compose;


  const enhancer =
    process.env.NODE_ENV === 'development'
      ? composeEnhancers(applyMiddleware(...middlewares))
      : compose(applyMiddleware(...middlewares));

  return createStore(reducers, enhancer);
};
