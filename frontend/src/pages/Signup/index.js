import * as C from "./style";
import React, {useState} from "react";
import { Link } from "react-router-dom";
import useAuth from "../../hooks/useAuth";
import { toast } from "react-toastify";
import Input from "../../components/Input";

const Signup = () => {
  const { signup } = useAuth();
  const [form, setForm] = useState({
    name: "",
    senha: "",
    email: "",
    emailConf: "",
  });

  const handleChange = (e) => {
    setForm({
      ...form,
      [e.target.name]: e.target.value,
    });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();

    let { name, email, emailConf, senha } = form

    if (!name || !email || !senha || !emailConf) {
      return toast.warn("Preencha todos os campos!");
    } else if (email !== emailConf) {
      return toast.warn("Os e-mails não são iguais");
    }

    await signup(email ,senha, name);

  }
    
  return (
    <C.Container>
      <C.Label>Gestão de Mercado</C.Label>
        <C.Content onSubmit={handleSubmit} >
          <Input type="text" name="name" placeholder="Digite seu Nome" value={form.name} onChange={(e) => setForm({...form, name: e.target.value})} />
          <Input type="email" name="email" placeholder="Digite seu E-mail" value={form.email} onChange={(e) => setForm({...form, email: e.target.value})} />
          <Input type="email"  name="emailConf" placeholder="Confirme seu E-mail" value={form.emailConf} onChange={(e) => setForm({...form, emailConf: e.target.value})}  />
          <Input type="password" name="senha" placeholder="Digite sua Senha" value={form.senha} onChange={(e) => setForm({...form, senha: e.target.value})} />
          <C.Button type="submit">Inscrever-se</C.Button>
          <C.LabelSignin>
            Já tem uma conta?
            <C.Strong><Link to="/">&nbsp;Entre</Link></C.Strong>
          </C.LabelSignin>
        </C.Content>
    </C.Container>
  );
};

export default Signup;
