import React, {useEffect} from "react";
import GridItem from "../../GridItem/Categoria";
import * as C from "./style";
import axios from "axios";
import { toast } from "react-toastify";

const Grid = ({ itens, setItens }) => {
  const fetchCategories = async () => {
    try {
      const response = await axios.get("http://localhost/produtos/listar_categoria",{responseType: 'json'});
      return response.data;
    } catch (error) {
      toast.error("Error fetching categories:", error);
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
          <C.Th width={40}>Nome</C.Th>
          <C.Th width={40}>Descrição</C.Th>
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