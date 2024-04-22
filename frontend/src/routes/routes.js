import { Fragment } from "react";
import { BrowserRouter, Route, Routes } from "react-router-dom";
import Home from "../pages/Home/home";
import Login from "../pages/Login/login";

const PrivateRoute = ({ item }) => {
  const signed = true;
  return signed > 0 ? item : <Login />;
};

const RoutesApp = () => {
  return (
    <BrowserRouter>
        <Fragment>
            <Routes>
                <Route path="/home" element={<PrivateRoute Item={Home} />} />
                <Route path="/login" element={<Login />} />
                <Route path="*" element={<Login />} />
            </Routes>
        </Fragment>
    </BrowserRouter>
  );
}

export default RoutesApp;