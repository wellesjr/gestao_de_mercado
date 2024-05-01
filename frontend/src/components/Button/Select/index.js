import React from "react";
import * as C from "./style";

const Select = ({ name, value, onChange, options = [], placeholder,  type = "select" }) => {
    return (
        <C.Select type={type} name={name} value={value} onChange={onChange}>
            <option value="">{placeholder}</option>
            {options.map((option) => (
                <option key={option.id} value={option.id}>
                    {option.nome}
                </option>
            ))}
        </C.Select>
    );
};
  
export default Select;