import React from "react";
import ResumeItem from "../ResumeItem";
import Button from "../../components/Button/onClick";
import * as C from "./style";
import {
  FaRegArrowAltCircleUp,
  FaRegArrowAltCircleDown,
  FaDollarSign,
} from "react-icons/fa";
import { useNavigate } from "react-router-dom";
import useAuth from "../../hooks/useAuth";

const Resume = ({ income, expense, total }) => {
  const { signout } = useAuth();
  const navigate = useNavigate();
  return (
    <C.Container>
      <C.Content>
        <Button Text="Cadastros" onClick={() => [navigate("/produtos")]} />
        <ResumeItem title="Entradas" Icon={FaRegArrowAltCircleUp} color="green" value={income} />
      </C.Content>
      <C.Content>
        <C.Title>Controle de Vendas</C.Title>
        <ResumeItem title="Saídas" Icon={FaRegArrowAltCircleDown} color="red" value={expense} />
      </C.Content>
      <C.Content>
        <Button Text="Sair" onClick={() => [signout(), navigate("/")]} />
        <ResumeItem title="Total" Icon={FaDollarSign} value={total} />
      </C.Content>
    </C.Container>
  );
};

export default Resume;