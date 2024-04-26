import { createContext, useEffect, useState } from "react";
import axios from 'axios';

export const AuthContext = createContext({});
export const AuthProvider = ({ children }) => {
  const [user, setUser] = useState();

  useEffect(() => {
    const userToken = localStorage.getItem("user_token");
    const usersStorage = localStorage.getItem("users_bd");

    if (userToken && usersStorage) {
      const hasUser = JSON.parse(usersStorage)?.filter(
        (user) => user.email === JSON.parse(userToken).email
      );
      if (hasUser){
        setUser(hasUser[0]);
      }
    }
  }, []);


  const signin = (email, password) => {
    const usersStorage = JSON.parse(localStorage.getItem("users_bd"));
    const hasUser = usersStorage?.filter((user) => user.email === email);

    if (hasUser?.length) {
      if (hasUser[0].email === email && hasUser[0].password === password) {
        const token = Math.random().toString(36).substring(2);
        localStorage.setItem("user_token", JSON.stringify({ email, token }));
        setUser({ email, password });
        return;
      } else {
        return "E-mail ou senha incorretos";
      }
    } else {
      return "Usuário não cadastrado";
    }
  };

  const signup = async (email, password, name) => {
    console.log(email);
    if (!email || !password || !name) {
      return "Por favor, preencha todos os campos.";
    }
    let usersStorage = JSON.parse(localStorage.getItem("users_bd")) || [];
    const hasUser = usersStorage.some(user => user.email === email);
  
    if (hasUser) {
      return "Já existe uma conta com esse E-mail";
    }
  
    try {
      const response = await axios.post('http://localhost/usuarios/cadastrar_usuario', { name, email, password });
      return response
      
      if (response.status === 200) {
        let newUser = [...usersStorage, { name, email, password }];
        localStorage.setItem("users_bd", JSON.stringify(newUser));

        return response.data.message;
      } else {
        throw new Error('Falha ao registrar o usuário no servidor');
      }
    } catch (error) {
      return `Erro ao cadastrar usuário: ${error.message}`;
    }
  };
  
  const signout = () => {
    setUser(null);
    localStorage.removeItem("user_token");
  };

  return (
    <AuthContext.Provider value={{ user, signed: !!user, signin, signup, signout }}>
      {children}
    </AuthContext.Provider>
  );
};