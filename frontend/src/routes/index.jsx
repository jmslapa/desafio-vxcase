import React from 'react';
import { Switch, Redirect } from 'react-router-dom';
import Loja from '../pages/Loja';
import Vendas from '../pages/Vendas';
import Route from './Route';

export default function Routes() {

  return (
    <Switch>
      <Route exact path="/loja" component={Loja}/>
      <Route exact path="/vendas" component={Vendas}/>
      <Redirect from="*" to="/loja"/>
    </Switch>
  );
}
