import { useState } from "react";
import BuscarDadosApi from "../../../services/util";
import Inserir from "../../../components/SaveModal";

export default function DayOffInsert() {
  const [diaSemana, setDiaSemana] = useState("");
  const [idUsuario, setIdUsuario] = useState({});
  let funcionario = BuscarDadosApi('funcionarios', 'list-employees-with-user-id');

  return (
    <>
        <select onChange={(e) => setIdUsuario(e.target.value)} required>
          <option>Escolha o Funcionario</option>
          {funcionario.map((element: any) => (
            <option value={[element.id_usuario]}>
              {element.nome} {element.profissão}
            </option>
          ))}
        </select>
        <select onChange={(e) => setDiaSemana(e.target.value)} required>
          <option>Dia da Semana</option>
          <option value={1}>Domingo</option>
          <option value={2}>Segunda Feira</option>
          <option value={3}>Terça Feira</option>
          <option value={4}>Quarta Feira</option>
          <option value={5}>Quinta Feira</option>
          <option value={6}>Sexta Feira</option>
          <option value={7}>Sabado</option>
        </select>
      <Inserir modulo="folgas" dados={{ dia_semana : diaSemana, id_usuario : idUsuario }} />
    </>
  );
}
