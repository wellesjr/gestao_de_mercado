import React from "react";
import GlobalStyle from "./styles/global";
import RoutesApp from "./routes";
import { AuthProvider } from "./contexts/auth";
import { toast, ToastContainer } from "react-toastify";
import 'react-toastify/dist/ReactToastify.css';
const App = () => {
    return (
        <AuthProvider> 
            <RoutesApp />
            <GlobalStyle />
            <ToastContainer autoClose={3000} position={toast.POSITION.TOP_RIGTH} />
        </AuthProvider>
    );
}

export default App;