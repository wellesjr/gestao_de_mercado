import React from "react";
import Button from "../../components/Button/onClick";
import * as C from "./style";
import { useNavigate } from "react-router-dom";
import useAuth from "../../hooks/useAuth";

const Resume = () => {
  const { signout } = useAuth();
  const navigate = useNavigate();
  return (
    <C.Container>
      <C.Content>
        <Button Text="Cadastros" onClick={() => [navigate("/produtos")]} />
        <C.Title>Controle de Vendas</C.Title>
        <Button Text="Sair" onClick={() => [signout(), navigate("/")]} />
      </C.Content>
    </C.Container>
  );
};

export default Resume;