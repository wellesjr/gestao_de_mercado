import styled from "styled-components";

export const Select = styled.select`
    outline: none;
    padding: 16px 20px;
    width: 100%;
    min-width: 135px;
    border-radius: 5px;
    font-size: 16px;
    background-color: #f0f2f5;
    border: none;
    color: rgb(118, 118, 118);
`;

export const groupStyles = styled.option`
    cursor: pointer;
    display: 'flex',
    alignItems: 'center',
    justifyContent: 'space-between',
    background-color: rgb(240, 242, 245);
    font-size: 16px;
`;

