import React from "react";
import { useNavigate } from "react-router-dom";
import Button from "../../components/Button";
import useAuth from "../../hooks/useAuth";
import * as C from "./style";

const Home = () => {
  const { signOut } = useAuth();
  const navigate = useNavigate();

  return (
    <C.Container>
      <C.Title>Home</C.Title>
      <Button Text="Sair" onClick={() => [signOut(), navigate("/")]}>
        Sair
      </Button>
    </C.Container>
  );
};

export default Home;