import React, { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import useAuth from "../../hooks/useAuth";
import Header from "../../components/Header";
import Resume from "../../components/Resume";
import Form from "../../components/Form/Home";

const Home = () => {
  const { signout } = useAuth();
  const navigate = useNavigate();

  const data = localStorage.getItem("sales");
  const [transactionsList, setTransactionsList] = useState(
    data ? JSON.parse(data) : []
  );

  const handleAdd = (transaction) => {
    const newArrayTransactions = [...transactionsList, transaction];
    setTransactionsList(newArrayTransactions);
    localStorage.setItem("sales", JSON.stringify(newArrayTransactions));
  };

  return (
    <>
    <Header />
    <Resume />
    <Form handleAdd={handleAdd} transactionsList={transactionsList} setTransactionsList={setTransactionsList}/>
    </>
  );
};

export default Home;