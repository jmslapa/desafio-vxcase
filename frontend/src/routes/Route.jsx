import React from 'react';
import { Route } from 'react-router-dom';
import Layout from '../components/Layout';

export default function RouteWrapper({
  component: Component,
  ...rest
}) {

  const componentRender = (props) => (
    <Layout>
      <Component {...props} />
    </Layout>
  )

  return (
    <Route {...rest} render={componentRender} />
  );
}
