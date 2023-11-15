import Profissao from "../../pages/Profissoes/adicionar";
import Funcionario from "../../pages/Funcionarios/inserir";
import Feriados from "../../pages/Feriados/inserir";
import Folgas from "../../pages/Folgas/inserir";
import Tratamentos from "../../pages/Tratamentos/inserir";

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
