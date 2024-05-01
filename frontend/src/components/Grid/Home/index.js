import React from "react";
import GridItem from "../../GridItem/Home";
import * as C from "./style";

const Grid = ({ itens, setItens }) => {
  const onDelete = (ID) => {
    const newArray = itens.filter((transaction) => transaction.id !== ID);
    setItens(newArray);
    localStorage.setItem("transactions", JSON.stringify(newArray));
  };

  return (
    <C.Table>
      <C.Thead>
        <C.Tr>
          <C.Th width={15}>Produto</C.Th>
          <C.Th width={15}>Descrição</C.Th>
          <C.Th width={15}>Categoria</C.Th>
          <C.Th width={10}>Valor</C.Th>
          <C.Th width={20}>Valor com imposto</C.Th>
          <C.Th width={15}>Quantidade</C.Th>
          <C.Th width={15}>Valor total</C.Th>
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