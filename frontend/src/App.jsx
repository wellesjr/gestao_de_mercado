import React from 'react';
import { BrowserRouter as Router, Route, Switch, Redirect } from 'react-router-dom';
import Login from './pages/Login/Login'; // Ajuste o caminho conforme a sua estrutura de pastas
import Home from './pages/Home/Home'; // Ajuste o caminho conforme a sua estrutura de pastas

function App() {
  return (
    <Router>
      <Switch>
        {/* Rota para a página de Login */}
        <Route path="/" component={Login} />

        {/* Rota para a página principal ou dashboard após o login */}
        <Route path="/home" component={Home} />

      </Switch>
    </Router>
  );
}

export default App;
