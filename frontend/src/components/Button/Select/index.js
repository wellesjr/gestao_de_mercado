import React from "react";
import * as C from "./style";

const Select = ({ name, value, onChange, options = [], placeholder,  type = "select" }) => {
    return (
        <C.Select type={type} name={name} value={value} onChange={onChange}>
            <option value="">{placeholder}</option>
            {options.map((option) => (
                <C.groupStyles key={option.value} value={option.value}>
                    {option.label}
                </C.groupStyles>
            ))}
        </C.Select>
    );
};
  
export default Select;