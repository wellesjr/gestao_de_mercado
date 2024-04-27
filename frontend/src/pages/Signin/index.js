import React, { useState } from "react";
import Input from "../../components/Input";
import * as C from "./style";
import { Link, useNavigate } from "react-router-dom";
import useAuth from "../../hooks/useAuth";
import { toast } from "react-toastify";

const Signin = () => {
  const { signin } = useAuth();
  const navigate = useNavigate();
  const [form, setForm] = useState({
    email: "",
    senha: "",
  });

  const handleChange = (e) => {
    setForm({
      ...form,
      [e.target.name]: e.target.value,
    });
  };

  const handleLogin = async (e) => {
    e.preventDefault();
    let { email, senha } = form
  
    if (!email | !senha) {
      return toast.warn("Preencha todos os campos!");
    }

    await signin(email, senha);
    navigate("/home");
  };

  return (
    <C.Container>
      <C.Label>Gestão de Mercado</C.Label>
      <C.Content onSubmit={handleLogin}>
        <Input type="email" name="email" placeholder="Digite seu E-mail" value={form.email} onChange={(e) => setForm({...form, email: e.target.value})} />
        <Input type="password" name="senha" placeholder="Digite sua Senha" value={form.senha} onChange={(e) => setForm({...form, senha: e.target.value})} />
        <C.Button type="submit">Entrar</C.Button>
        <C.LabelSignup>
          Não tem uma conta?
          <C.Strong>
            <Link to="/signup">&nbsp;Registre-se</Link>
          </C.Strong>
        </C.LabelSignup>
      </C.Content>
    </C.Container>
  );
};

export default Signin;