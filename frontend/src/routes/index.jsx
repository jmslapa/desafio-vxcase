import React from 'react';
import { Switch, Redirect } from 'react-router-dom';
import Produtos from '../pages/Produtos';
import Route from './Route';

export default function Routes() {

  return (
    <Switch>
      <Route exact path="/" component={Produtos}/>
      <Redirect from="*" to="/"/>
    </Switch>
  );
}
