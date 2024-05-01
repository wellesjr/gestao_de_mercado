import React, { useEffect, useState } from "react";
import Form from "../../components/Form/Produtos";
import * as C from "./style";
import Header from "../../components/Header";
import Button from "../../components/Button/onClick";
import useAuth from "../../hooks/useAuth";
import { useNavigate } from "react-router-dom";

const Produtos = () => {
  const { signout } = useAuth();
  const navigate = useNavigate();

  const tax = localStorage.getItem("tax");
  const category = localStorage.getItem("category");
  const products = localStorage.getItem("products");

  const [transactionsTaxList, setTaxTransactionsList] = useState( tax ? JSON.parse(tax) : []);
  const [transactionsCategoryList, setCategoryTransactionsList] = useState( category ? JSON.parse(category) : []);
  const [transactionsList, setTransactionsList] = useState( products ? JSON.parse(products) : []);
  const [income, setIncome] = useState(0);
  const [expense, setExpense] = useState(0);
  const [total, setTotal] = useState(0);

  // useEffect(() => {
  //   const amountExpense = transactionsList.filter((item) => item.expense) .map((transaction) => Number(transaction.amount));
  //   const amountIncome  = transactionsList.filter((item) => !item.expense).map((transaction) => Number(transaction.amount));

  //   const income  = amountIncome.reduce((acc, cur) => acc + cur, 0).toFixed(2);
  //   const expense = amountExpense.reduce((acc, cur) => acc + cur, 0).toFixed(2);

  //   const total = Math.abs(income - expense).toFixed(2);

  //   setIncome(`R$ ${income}`);
  //   setExpense(`R$ ${expense}`);
  //   setTotal(`${Number(income) < Number(expense) ? "-" : ""}R$ ${total}`);
  // }, [transactionsList]);

  const handleAdd = (transaction, type) => {
    let item;
    switch (type) {
      case "tax"     : item = 'tax';      break;
      case "sales"   : item = 'sales' ;   break;
      case "product" : item = 'product';  break;
      case "category": item = 'category'; break; 
    }

    const newArrayTransactions = [...transactionsList, transaction];
    setTransactionsList(newArrayTransactions);
    localStorage.setItem(item, JSON.stringify(newArrayTransactions));
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
    <Form handleAdd={handleAdd} transactionsList={transactionsList} setTransactionsList={setTransactionsList}/>
    </>
  );
};

export default Produtos;