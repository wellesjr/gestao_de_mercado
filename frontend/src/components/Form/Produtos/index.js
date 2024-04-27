import './css.css';
import Input from "../../Input";
import * as C from "./style";
import Grid from "../../Grid/Produtos";
import Select from '../../Button/Select';
import Button from "../../Button/onClick";
import { toast } from "react-toastify";
import React, { useState } from "react";
import { Tab, Tabs, TabList, TabPanel } from 'react-tabs';

const Form = ({ handleAdd, transactionsList, setTransactionsList }) => {
  const [desc, setDesc] = useState("");
  const [amount, setAmount] = useState("");
  const [isExpense, setExpense] = useState(false);
  const [selectedValue, setSelectedValue] = useState('');

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
      <Tabs>
        <TabList>
          <Tab>Categorias</Tab>
          <Tab>Imposto por categoria</Tab>
          <Tab>Produtos</Tab>
        </TabList>

        <TabPanel>
          <C.Container>
            <C.InputContent>
              <Input type="text" placeholder="Nome" value={desc} onChange={(e) => setDesc(e.target.value)} />
            </C.InputContent>
            <C.InputContent>
              <Input type="text" placeholder="Descrição" value={desc} onChange={(e) => setDesc(e.target.value)} />
            </C.InputContent>
            <Button Text="ADICIONAR" onClick={handleSave} />
          </C.Container>
          <Grid itens={transactionsList} setItens={setTransactionsList} />
        </TabPanel>
        <TabPanel>
          <C.Container>
            <C.InputContent>
            <Select name="Categoria" value={selectedValue} onChange={(e) => setSelectedValue(e.target.value)} options={options} placeholder={"Selecione a categoria"} />
            </C.InputContent>
            <C.InputContent>
              <Input type="number" placeholder="Imposto %" value={desc} onChange={(e) => setDesc(e.target.value)} />
            </C.InputContent>
            <C.InputContent>
              <Input type="number" placeholder="Valor" value={amount} onChange={(e) => setAmount(e.target.value)} />
            </C.InputContent>
            <Button Text="ADICIONAR" onClick={handleSave} Class="addImposto" />
          </C.Container>
          <Grid itens={transactionsList} setItens={setTransactionsList} />
        </TabPanel>
        <TabPanel>
          <C.Container>
            <C.InputContent>
              <Input type="text" placeholder="Nome" value={desc} onChange={(e) => setDesc(e.target.value)} />
            </C.InputContent>
            <C.InputContent>
              <Input type="text" placeholder="Descrição" value={desc} onChange={(e) => setDesc(e.target.value)} />
            </C.InputContent>
            <C.InputContent>
              <Input type="number" placeholder="Valor" value={amount} onChange={(e) => setAmount(e.target.value)} />
            </C.InputContent>
            <C.RadioGroup>
              <C.Input type="radio" id="rIncome" defaultChecked name="group1" onChange={() => setExpense(!isExpense)} />
              <C.Label htmlFor="rIncome">Entrada</C.Label>
              <C.Input type="radio" id="rExpenses" name="group1" onChange={() => setExpense(!isExpense)} />
              <C.Label htmlFor="rExpenses">Saída</C.Label>
            </C.RadioGroup>
            <Button Text="ADICIONAR" onClick={handleSave} />
          </C.Container>
          <Grid itens={transactionsList} setItens={setTransactionsList} />
        </TabPanel>
      </Tabs>
    </>
  );
};

export default Form;