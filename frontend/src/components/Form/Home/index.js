import React, { useState, useEffect } from "react";
import Grid from "../../Grid/Home";
import * as C from "./style";
import Select from "../../Button/Select";
import Button from "../../Button/onClick";
import Input from "../../Input";
import { toast } from "react-toastify";
import axios from "axios";

const Form = ({ handleAdd, transactionsList, setTransactionsList }) => {
  const fetchProdutos = async () => {
    try {
      const response = await axios.get("http://localhost/produtos/listar_produto",{responseType: 'json'});
      return response.data;
    } catch (error) {
      toast.error("Error ao buscar produtos:", error);
      return [];
    }
  };

  useEffect(() => {
    const fetchData = async () => {
      let data = await fetchProdutos();
      if (data.success === false) {
        toast.error(data.message);
        return;
      }
      productsOptions(data.data);
    };
  
    fetchData();
  }, []);

  const [amount, setAmount] = useState("");
  const [options, productsOptions] = useState([]);
  const [selectedValue, setSelectedValue] = useState('');

  const generateID = () => Math.round(Math.random() * 1000);

  const handleSave = () => {
    if (!selectedValue || !amount) {
      toast.warn("Selecione o produto e informe a quantidade!");
      return;
    } else if (amount < 1) {
      toast.error("A quantidade tem que ser positivo!");
      return;
    }

    const transaction = {
      id: generateID(),
      amount: amount,
    };

    handleAdd(transaction);
    setAmount("");
    setSelectedValue("");
  };

  
  return (
    <>
      <C.Container>
        <C.InputContent>
        <Select name="produtos" value={selectedValue} onChange={(e) => setSelectedValue(e.target.value)} options={options} placeholder={"Selecione o produto"} />
        </C.InputContent>
        <C.InputContent>
          <Input type="number" placeholder="Quantidade" value={amount} onChange={(e) => setAmount(e.target.value)} />
        </C.InputContent>
        <Button Text="ADICIONAR" onClick={handleSave} />
      </C.Container>
      <Grid itens={transactionsList} setItens={setTransactionsList} />
    </>
  );
};

export default Form;