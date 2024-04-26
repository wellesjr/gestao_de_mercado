import React from "react";
import * as C from "./style";

const Input = ({ type, name, placeholder, value, onChange }) => {
  return (
    <C.Input
      type={type}
      nome={name}
      value={value}
      onChange={onChange}
      placeholder={placeholder}
    />
  );
};

export default Input;