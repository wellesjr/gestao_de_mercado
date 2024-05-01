import React, {useEffect} from "react";
import * as C from "./style";
import axios from "axios";
import GridItem from "../../GridItem/Imposto";

const Grid = ({ itens, setItens }) => {
  const fetchCategories = async () => {
    try {
      const response = await axios.get("http://localhost/produtos/listar_imposto",{responseType: 'json'});
      return response.data;
    } catch (error) {
      console.error("Error fetching categories:", error);
      return [];
    }
  };

  useEffect(() => {
    const fetchData = async () => {
      let data = await fetchCategories();
      if (data.success === false) {
        TransformStream.error(data.message);
        return;
      }
      setItens(data.data);
    };

    fetchData();
  }, []);

  const onDelete = (ID) => {
    const newArray = itens.filter((transaction) => transaction.imposto_id !== ID);
    setItens(newArray);
    localStorage.setItem("transactions", JSON.stringify(newArray));
  };

  return (
    <C.Table>
      <C.Thead>
        <C.Tr>
          <C.Th width={40}>Categoria</C.Th>
          <C.Th width={40}>Imposto %</C.Th>
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