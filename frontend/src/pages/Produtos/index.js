import React, { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import Button from "../../components/Button/onClick";
import useAuth from "../../hooks/useAuth";
import * as C from "./style";
import Header from "../../components/Header";
import Form from "../../components/Form/Produtos";

const Produtos = () => {
  const { signout } = useAuth();
  const navigate = useNavigate();

  const data = localStorage.getItem("products");
  const [transactionsList, setTransactionsList] = useState(
    data ? JSON.parse(data) : []
  );
  const [income, setIncome] = useState(0);
  const [expense, setExpense] = useState(0);
  const [total, setTotal] = useState(0);

  useEffect(() => {
    const amountExpense = transactionsList
      .filter((item) => item.expense)
      .map((transaction) => Number(transaction.amount));

    const amountIncome = transactionsList
      .filter((item) => !item.expense)
      .map((transaction) => Number(transaction.amount));

    const expense = amountExpense.reduce((acc, cur) => acc + cur, 0).toFixed(2);
    const income = amountIncome.reduce((acc, cur) => acc + cur, 0).toFixed(2);

    const total = Math.abs(income - expense).toFixed(2);

    setIncome(`R$ ${income}`);
    setExpense(`R$ ${expense}`);
    setTotal(`${Number(income) < Number(expense) ? "-" : ""}R$ ${total}`);
  }, [transactionsList]);

  const handleAdd = (transaction) => {
    const newArrayTransactions = [...transactionsList, transaction];

    setTransactionsList(newArrayTransactions);

    localStorage.setItem("products", JSON.stringify(newArrayTransactions));
  };


  return (
    <>
    <Header />
    < C.Container>
        <C.Content>
        <Button Text="voltar" onClick={() => [navigate("/home")]} />
        <C.Title>Cadastros</C.Title>
        <Button Text="Sair" onClick={() => [signout(), navigate("/")]} />
      </C.Content>
    </C.Container>
    <Form
      handleAdd={handleAdd}
      transactionsList={transactionsList}
      setTransactionsList={setTransactionsList}
    />
    </>
  );
};

export default Produtos;