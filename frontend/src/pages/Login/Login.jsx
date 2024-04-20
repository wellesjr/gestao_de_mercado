import React, { useState } from 'react';

function Login() {
  const [username, setUsername] = useState('');
  const [password, setPassword] = useState('');
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState('');

  const handleLogin = async (event) => {
    event.preventDefault();
    setLoading(true);
    setError('');

    try {
      // Aqui você adicionaria a lógica de autenticação, talvez enviando uma requisição para um backend.
      console.log('Username:', username, 'Password:', password);
      // Simular uma chamada de API
      setTimeout(() => {
        setLoading(false);
        alert('Login successful!'); // Simulação de sucesso
      }, 1000);
    } catch (err) {
      setLoading(false);
      setError('Falha ao entrar. Verifique suas credenciais.');
    }
  };

  return (
    <div>
      <h1>Login</h1>
      <form onSubmit={handleLogin}>
        <div>
          <label htmlFor="username">Username:</label>
          <input
            type="text"
            id="username"
            value={username}
            onChange={(e) => setUsername(e.target.value)}
            required
          />
        </div>
        <div>
          <label htmlFor="password">Password:</label>
          <input
            type="password"
            id="password"
            value={password}
            onChange={(e) => setPassword(e.target.value)}
            required
          />
        </div>
        <button type="submit" disabled={loading}>
          {loading ? 'Carregando...' : 'Entrar'}
        </button>
        {error && <p>{error}</p>}
      </form>
    </div>
  );
}

export default Login;