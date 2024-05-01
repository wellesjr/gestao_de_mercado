import React from "react";
import * as C from "./style";
import {FaTrash} from "react-icons/fa";

const GridItem = ({ item, onDelete }) => {
  return (
    <C.Tr>
      <C.Td>{item.nomeproduto}</C.Td>
      <C.Td>{item.descricao}</C.Td>
      <C.Td>{item.nomecategoria}</C.Td>
      <C.Td>R$ {item.originalvalue}</C.Td>
      <C.Td>R$ {item.valorimposto}</C.Td>
      <C.Td>{item.quantidade}</C.Td>
      <C.Td>R$ {item.valortotal}</C.Td>
      <C.Td alignCenter>
        <FaTrash onClick={() => onDelete(item.id)} />
      </C.Td>
    </C.Tr>
  );
};

export default GridItem;