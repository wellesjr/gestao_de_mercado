import { createContext, useEffect, useState } from "react";

export const AuthContext = createContext({});

export const AuthProvider = ({ children }) => {
    const [user, setUser] = useState();

    useEffect(() => {
        const useToken = localStorage.getItem("user_token");
        const userStorage = localStorage.getItem("users_db");

        if (useToken && userStorage) {
            const hasUser = JSON.parse(userStorage)?.filter(
                (user) => user.email === JSON.parse(useToken).email
            );

            if (hasUser) setUser(hasUser[0]);
        }
    }, []);

    const signIn = (email, password) => {
        const usersStorage = JSON.parse(localStorage.getItem("users_db"));
        const hasUser = usersStorage?.filter((user) => user.email === email);

        if(hasUser.length > 0){
            if(hasUser[0].password === password){
                const token = Math.random().toString(36).substring(2);
                localStorage.setItem("user_token", JSON.stringify(hasUser[0]));
                setUser({ email, password});
                return;
            } else {
                return "E-mail ou senha inválidos";
            }
        } else {
            return "Usuário não cadastrado";
        }
    }

    const signOut = () => {
        setUser(null);
        localStorage.removeItem("user_token");
    }

    return (
        <AuthContext.Provider value={{ user, signed: !!user, signIn, signOut }}>
            {children}
        </AuthContext.Provider>
    );
}