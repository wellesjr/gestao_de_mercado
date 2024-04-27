import React from "react";
import * as C from "./style";

const ResumeItem = ({ title, Icon, color, value }) => {
  return (
    <C.Container>
      <C.Header>
        <C.HeaderTitle>{title}</C.HeaderTitle>
        <Icon color={color} />
      </C.Header>
      <C.Total>{value}</C.Total>
    </C.Container>
  );
};

export default ResumeItem;