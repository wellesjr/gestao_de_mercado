import React from "react";
import * as C from "./style";
import { FaTrash} from "react-icons/fa";

const GridItem = ({ item, onDelete }) => {
  return (
    <C.Tr>
      <C.Td>{item.nome}</C.Td>
      <C.Td>{item.percentual} %</C.Td>
      <C.Td alignCenter>
        <FaTrash onClick={() => onDelete(item.imposto_id)} />
      </C.Td>
    </C.Tr>
  );
};

export default GridItem;