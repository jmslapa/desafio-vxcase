import React from 'react';
import { Switch, Redirect } from 'react-router-dom';
import Loja from '../pages/Loja';
import Route from './Route';

export default function Routes() {

  return (
    <Switch>
      <Route exact path="/loja" component={Loja}/>
      <Redirect from="*" to="/loja"/>
    </Switch>
  );
}
