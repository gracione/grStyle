import Profissao from "../../pages/Professions/adicionar";
import Funcionario from "../../pages/Employees/EmployeeInsert";
import Feriados from "../../pages/Holidays/inserir";
import Folgas from "../../pages/DaysOff/inserir";
import Tratamentos from "../../pages/Services/inserir";

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
