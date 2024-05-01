import React, { useState } from "react";
import Header from "../../components/Header";
import Resume from "../../components/Resume";
import Form from "../../components/Form/Home";
import axios from "axios";
import { toast } from "react-toastify";

const Home = () => {
  const data = localStorage.getItem("sales");
  const [transactionsList, setTransactionsList] = useState(
    data ? JSON.parse(data) : []
  );

  const handleAdd = async (transaction) => {
    try {
      const response = await axios.post("http://localhost/produtos/cadastrar_vendas",{
        quantidade: transaction.quantidade,
        produto_id: transaction.produto_id,
      }, { headers: { 'Content-Type': 'application/json' }, responseType: 'json' });
      if (response.data.success === false) {
        toast.error(response.data.message);
        return;
      }
      localStorage.setItem("sales", JSON.stringify([...transactionsList, response.data.dados]));
      setTransactionsList([...transactionsList, response.data.dados]);
      toast.success(response.data.message);
    } catch (error) {
      toast.error("Error saving transaction:", error);
    }
  };

  return (
    <>
      <Header />
      <Resume />
      <Form handleAdd={handleAdd} transactionsList={transactionsList} setTransactionsList={setTransactionsList} />
    </>
  );
};

export default Home;