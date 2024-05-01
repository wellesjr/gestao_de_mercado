import './css.css';
import Input from "../../Input";
import * as C from "./style";
import Grid from "../../Grid/Produtos";
import Button from "../../Button/onClick";
import Select from '../../Button/Select';
import GridImposto from '../../Grid/Impostos';
import GridCategorias from '../../Grid/Categorias';
import { toast } from "react-toastify";
import React, { useState, useEffect } from "react";
import { Tab, Tabs, TabList, TabPanel } from 'react-tabs';
import axios from "axios";

const Form = ({ handleAdd, transactionsList, setTransactionsList }) => {
  const fetchCategories = async () => {
    try {
      const response = await axios.get("http://localhost/produtos/listar_categoria",{responseType: 'json'});
      return response.data;
    } catch (error) {
      toast.error("Error ao buscar categorias:", error);
      return [];
    }
  };

  useEffect(() => {
    const fetchData = async () => {
      let data = await fetchCategories();
      if (data.success === false) {
        toast.error(data.message);
        return;
      }
      categoryOptions(data.data);
    };
  
    fetchData();
  }, []);

  const [category, setCategory] = useState("");
  const [categoryDescription, setcategoryDescription] = useState("");
  
  const [options, categoryOptions] = useState([]);

  const [selectedValue, setSelectedValue] = useState('');
  const [tax, setTax] = useState("");
  const [selectedValueTax, setSelectedValueTax] = useState('');


  const [desc, setDesc] = useState("");
  const [amount, setAmount] = useState("");
  const [isExpense, setExpense] = useState(false);

  const generateID = () => Math.round(Math.random() * 1000);

  const handleSave = (type) => {

    switch (type) {
      case "category": return categories();
      case "imposto":  return imposto();
      case "produto":  return produto();
    }

    const categories = () => {
      if (!category) {
        toast.warn("Informe o nome da categoria!");
        return;
      }
      const transaction = {
        id: generateID(),
        nome: category,
        desc: categoryDescription,
      };

      handleAdd(transaction, category);
  
      setDesc("");
      setAmount("");
    };

    const imposto = () => {
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

    const produto = () => {
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

  };
 
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
              <Input type="text" placeholder="Nome" value={category} onChange={(e) => setCategory(e.target.value)} />
            </C.InputContent>
            <C.InputContent>
              <Input type="text" placeholder="Descrição" value={categoryDescription} onChange={(e) => setcategoryDescription(e.target.value)} />
            </C.InputContent>
            <Button Text="ADICIONAR" onClick={(e) => handleSave(e, "category")} />
          </C.Container>
          <GridCategorias itens={transactionsList} setItens={setTransactionsList} />
        </TabPanel>
        <TabPanel>
          <C.Container>
            <C.InputContent>
            <Select name="Categoria" value={selectedValueTax} onChange={(e) => setSelectedValueTax(e.target.value)} options={options} placeholder={"Selecione a categoria"} />
            </C.InputContent>
            <C.InputContent>
              <Input type="number" placeholder="Imposto %" value={tax} onChange={(e) => setTax(e.target.value)} />
            </C.InputContent>
            <Button Text="ADICIONAR" onClick={(e) => handleSave(e, "imposto")} Class="addImposto" />
          </C.Container>
          <GridImposto itens={transactionsList} setItens={setTransactionsList} />
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
            <Select name="Categoria" value={selectedValue} onChange={(e) => setSelectedValue(e.target.value)} options={options} placeholder={"Selecione a categoria"} />
            </C.InputContent>
            <C.InputContent>
              <Input type="number" placeholder="Valor" value={amount} onChange={(e) => setAmount(e.target.value)} />
            </C.InputContent>
            <Button Text="ADICIONAR" onClick={(e) => handleSave(e, "produto")} />
          </C.Container>
          <Grid itens={transactionsList} setItens={setTransactionsList} />
        </TabPanel>
      </Tabs>
    </>
  );
};

export default Form;