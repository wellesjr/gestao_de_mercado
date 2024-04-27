import axios from "axios";
import { toast } from "react-toastify";
import { createContext, useEffect, useState } from "react";

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
      if (hasUser) setUser(hasUser[0]);
    }
  },[]);

  const signin = async (email, password) => {
    const usersStorage = JSON.parse(localStorage.getItem("users_bd"));
    const hasUser = usersStorage?.filter((user) => user.email === email);
    const token = Math.random().toString(36).substring(2);

    if (hasUser?.length) {
      if (hasUser[0].email === email && hasUser[0].password === password) {
        localStorage.setItem("user_token", JSON.stringify({ email, token }));
        setUser({ email, password });
        return;
      } else {
        toast.error("E-mail ou senha incorretos");
        return;
      }
    } else {
      await axios.post('http://localhost/usuarios/login', {
        email: email,
        senha: password
      },
      { headers: {'Content-Type': 'application/json'}, responseType: 'json'})
        .then(({ data }) => {
          if(data.success == true){
            localStorage.setItem("user_token", JSON.stringify({token}));
            setUser({ email, password });
            toast.success(data.message);
          } else {
            toast.error(data.message);
          }
          return;
      })
    }
  };

  const signup = async (email, password, nome ) => {
    let newUser;
    let usersStorage = JSON.parse(localStorage.getItem("users_bd"));
    let hasUser = usersStorage?.filter((user) => user.email === email);

    if (hasUser?.length) {
      toast.success("Já tem uma conta com esse E-mail");
      return;
    }

    await axios.post('http://localhost/usuarios/cadastrar_usuario', {
      nome: nome,
      email: email,
      senha: password
    },
    { headers: {'Content-Type': 'application/json'}, responseType: 'json'})
      .then(({ data }) => {
        if(data.success == true){
          if (usersStorage) {
            newUser = [...usersStorage, { email, password }];
          } else {
            newUser = [{ email, password }];
          }
          localStorage.setItem("users_bd", JSON.stringify(newUser));
          toast.success(data.message);
        } else {
          toast.error(data.message);
        }
        return data.message;
    })
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