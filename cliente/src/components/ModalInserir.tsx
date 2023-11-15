import Profissao from "../../src/pages/Profissoes/adicionar";
import Funcionario from "../../src/pages/Funcionarios/inserir";
import Feriados from "../../src/pages/Feriados/inserir";
import Folgas from "../../src/pages/Folgas/inserir";
import Tratamentos from "../../src/pages/Tratamentos/inserir";

export default function ModalInserir(props: any) {
  const { funcao } = props;

  let paginaInserir;

  if (funcao === "funcionarios") {
    paginaInserir = <Funcionario />;
  } else if (funcao === "feriados") {
    paginaInserir = <Feriados />;
  } else if (funcao === "profissao") {
    paginaInserir = <Profissao />;
  } else if (funcao === "folgas") {
    paginaInserir = <Folgas />;
  } else if (funcao === "servicos-profissao") {
    paginaInserir = <Tratamentos />;
  }

  return <>{paginaInserir}</>;
}
