import styled from "styled-components";

export const Container = styled.div`
  max-width: 1120px;
  width: 100%;
  margin: 0 auto;
  display: flex;
  gap: 20px;
  margin-top: -125px;
  justify-content: space-between;
`;

export const Header = styled.h1`
  display: flex;
  justify-content: flex-end;
  align-items: baseline;
  align-content: space-between;
  flex-wrap: nowrap;
  flex-direction: row;
}`;

export const Title = styled.div`
  color: white;
  font-weight: 700;
  font-size: 32px;
`;

export const Content = styled.div`
  gap: 15px;
  display: flex;
  align-items: center;
  flex-direction: column;
  width: 100%;
  max-width: 350px;
  height: 215px;
  justify-content: space-between;
`;
