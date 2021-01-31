export function addProductToCart(product) {
  return {
    type: '@cart/ADD_PRODUCT',
    payload: { product },
  };
}

export function removeProductFromCart(product) {
  return {
    type: '@cart/REMOVE_PRODUCT',
    payload: { product },
  };
}

export function emptyCart() {
  return {
    type: '@cart/EMPTY',
  };
}
