import React, { useState } from "react";
import Grid from "../../Grid/Produtos";
import * as C from "./style";
import Select from "../../Button/Select";
import Input from "../../Input";
import { toast } from "react-toastify";


const Form = ({ handleAdd, transactionsList, setTransactionsList }) => {
  const [selectedValue, setSelectedValue] = useState('');
  const [desc, setDesc] = useState("");
  const [amount, setAmount] = useState("");
  const [isExpense, setExpense] = useState(false);

  const generateID = () => Math.round(Math.random() * 1000);

  const handleSave = () => {
    if (!desc || !amount) {
      toast.warn("Informe a descrição e o valor!");
      return;
    } else if (amount < 1) {
      toast.error("O valor tem que ser positivo!");
      return;
    }

    const transaction = {
      id: generateID(),
      desc: desc,
      amount: amount,
      expense: isExpense,
    };

    handleAdd(transaction);
    setDesc("");
    setAmount("");
  };

  let options = [{label:"Produto 1", value:"1"}, {label:"Produto 2", value:"2"}, {label:"Produto 3", value:"3"}];
  
  return (
    <>
      <C.Container>
        <C.InputContent>
        <Select name="produtos" value={selectedValue} onChange={(e) => setSelectedValue(e.target.value)} options={options} placeholder={"Selecione o produto"} />
        </C.InputContent>
        <C.InputContent>
          <Input type="number" placeholder="Quantidade" value={amount} onChange={(e) => setAmount(e.target.value)} />
        </C.InputContent>
        <C.RadioGroup>
          <C.Input type="radio" id="rIncome" defaultChecked name="group1" onChange={() => setExpense(!isExpense)} />
          <C.Label htmlFor="rIncome">Compra</C.Label>
          <C.Input type="radio" id="rExpenses" name="group1" onChange={() => setExpense(!isExpense)} />
          <C.Label htmlFor="rExpenses">Venda</C.Label>
        </C.RadioGroup>
        <C.Button Text="ADICIONAR" onClick={handleSave} />
      </C.Container>
      <Grid itens={transactionsList} setItens={setTransactionsList} />
    </>
  );
};

export default Form;