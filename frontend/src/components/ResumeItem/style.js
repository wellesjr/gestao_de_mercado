import styled from "styled-components";

export const Container = styled.div`
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  width: 100%;
  box-shadow: 0 5px 15px #0003;
  background-color: rgb(240, 242, 245);
  max-width: 350px;
  padding: 15px 0 15px 0;
  border-radius: 10px;
  min-height: 140px;

  @media (max-width: 750px) {
    width: 20%;

    p {
      font-size: 12px;
    }

    span {
      font-size: 20px;
    }

    svg {
      display: none;
    }
  }
`;

export const Header = styled.header`
  display: flex;
  align-items: center;
  justify-content: space-between;
  width: 100%;
  gap: 10px;
  margin-bottom: 25px;
  padding: 0 15px;

  svg {
    width: 25px;
    height: 25px;
  }
`;

export const HeaderTitle = styled.p`
  font-size: 20px;
`;

export const Total = styled.span`
  font-size: 34px;
  font-weight: 700;
`;