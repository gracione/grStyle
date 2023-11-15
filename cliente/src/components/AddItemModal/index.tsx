import Profissao from "../../pages/Professions/adicionar";
import Funcionario from "../../pages/Employees/EmployeeInsert";
import Feriados from "../../pages/Holidays/HolidayInsert";
import Folgas from "../../pages/DaysOff/DayOffInsert";
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
