export function signInRequest(login, senha) {
  return {
    type: '@auth/SIGN_IN_REQUEST',
    payload: { login, senha },
  };
}

export function signInSuccess(token, user, env, isMaster) {
  return {
    type: '@auth/SIGN_IN_SUCCESS',
    payload: { token, user, env, isMaster },
  };
}

export function signOutSuccess() {
  return { type: '@auth/SIGN_OUT_SUCCESS' }
}

export function signInFailure() {
  return {
    type: '@auth/SIGN_IN_FAILURE',
  };
}

export function signUpRequest(
  nome_usuario,
  sobrenome_usuario,
  email_usuario,
  senha
) {
  return {
    type: '@auth/SIGN_UP_REQUEST',
    payload: { nome_usuario, sobrenome_usuario, email_usuario, senha },
  };
}

export function signOut() {
  return {
    type: '@auth/SIGN_OUT',
  };
}
