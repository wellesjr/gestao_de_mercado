import React, {useEffect} from "react";
import GridItem from "../../GridItem/Produtos";
import * as C from "./style";
import axios from "axios";

const Grid = ({ itens, setItens }) => {
  const fetchProducts = async () => {
    try {
      const response = await axios.get("http://localhost/produtos/listar_produto",{responseType: 'json'});
      return response.data;
    } catch (error) {
      return [];
    }
  };

  useEffect(() => {
    const fetchData = async () => {
      let data = await fetchProducts();
      if (data.success === false) {
        TransformStream.error(data.message);
        return;
      }
      setItens(data.data);
    };

    fetchData();
  }, []);


  const onDelete = (ID) => {
    const newArray = itens.filter((transaction) => transaction.id !== ID);
    setItens(newArray);
    localStorage.setItem("transactions", JSON.stringify(newArray));
  };

  return (
    <C.Table>
      <C.Thead>
        <C.Tr>
          <C.Th width={20}>Nome</C.Th>
          <C.Th width={30}>Descrição</C.Th>
          <C.Th width={20}>Categoria</C.Th>
          <C.Th width={10}>Valor</C.Th>
          <C.Th width={20}>Valor com imposto</C.Th>
          <C.Th width={10}></C.Th>
        </C.Tr>
      </C.Thead>
      <C.Tbody>
        {itens?.map((item, index) => (
          <GridItem key={index} item={item} onDelete={onDelete} />
        ))}
      </C.Tbody>
    </C.Table>
  );
};

export default Grid;