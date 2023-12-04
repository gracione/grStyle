import styled from "styled-components";

export const Container = styled.div`
  padding: 3vh;
  height: 100vh;
  display: flex;

  @media (min-width: 768px) {
    form {    
      width: 50%;
      height: 60vh;
    }
  }

  @media (max-width: 767px) {
    form {
      flex-direction: column;
      justify-content: space-between;
      width: 100%;
      height: 50vh;
    }
  }
`;
