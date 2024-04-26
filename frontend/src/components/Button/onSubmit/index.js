import React from "react";
import * as C from "./style";

const ButtonSub = ({ Text, OnSubmit , Type = "button" }) => {
  return (
    <C.Button type={Type} OnSubmit={OnSubmit}>
      {Text}
    </C.Button>
  );
};

export default ButtonSub;