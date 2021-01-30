import { takeLatest, call, put, all } from 'redux-saga/effects';
import { toast } from 'react-toastify';
import api from '../../../services/api';
import history from '../../../services/history';
import { signInSuccess, signInFailure, signOutSuccess } from './actions';
import { updateProfileSuccess, updateProfilefailure } from '../user/actions';
import errorHandler from '../../../services/errorHandler'
import app from '../../../config/app'

export function* signIn({ payload }) {
  try {
    const { login, senha } = payload;
    const getTokenResponse = yield call(api.post, 'auth/login', {
      login,
      senha,
    });
    
    const token = getTokenResponse.data;
    const { access_token, token_type } = token;    
    
    api.defaults.headers.Authorization = `${token_type} ${access_token}`;

    const getUserResponse = yield call(api.post, 'auth/usuario');
    const user = getUserResponse.data.data;   
    
    const getCompanyResponse = yield call(api.get, `empresas/${user.empresa.uuid}`);
    const layout = getCompanyResponse.data.data.layout[0];
    const env = {
      primaryColor: layout.des_cor_primaria,
      secondaryColor: layout.des_cor_secundaria
    }

    if(user.grupos.map(g => g.uuid === app.master.identifier).length) {
      yield put(signInSuccess(token, user, env, true));
      history.push('/master/dashboard');
    } else {     
      yield put(signInSuccess(token, user, env, false));
      history.push('/profile'); 
    }
    
    return;

  } catch (err) {
    toast.error(`Falha na autenticação, verifique se os dados informados estão corretos.`);
    yield put(signInFailure());
  }
}

export function* signUp({ payload }) {
  try {
    const {
      nome_usuario,
      sobrenome_usuario,
      email_usuario,
      senha,
    } = payload;

    yield call(api.post, 'usuarios/salvar', {
      nome_usuario,
      sobrenome_usuario,
      email_usuario,
      senha,
      id_papeis_usuario: 3,
    });

    history.push('/');
  } catch (err) {
    toast.error('Falha no cadastro, verifique seus dados.');

    yield put(signInFailure());
  }
}

export function* fetchAuthenticated() {
  try {

    const response = yield call(api.post, 'auth/usuario');
    const profile = response.data.data;

    toast.success('Perfil atualizado com sucesso!'); 
    yield put(updateProfileSuccess(profile));

  } catch (error) {
    errorHandler(error, 'Erro ao atualizar perfil.')
    yield put(updateProfilefailure());
  }
}

export function* signOut() {
  try {    
    yield call(api.post, 'auth/logout');    
    yield put(signOutSuccess())
  } catch (error) {
    errorHandler(error, 'Não foi possível efetual sign out.');
  }
}

export function setToken({ payload }) {
  if (!payload) return;
  const { token, tokenType } = payload.auth;
  if (token) {
    api.defaults.headers.common['Authorization'] = `${tokenType} ${token}`;
  }
}

export default all([
  takeLatest('persist/REHYDRATE', setToken),
  takeLatest('@auth/SIGN_IN_REQUEST', signIn),
  takeLatest('@auth/SIGN_UP_REQUEST', signUp),
  takeLatest('@auth/SIGN_OUT', signOut),
  takeLatest('@auth/FETCH_AUTHENTICATED', fetchAuthenticated),
]);
