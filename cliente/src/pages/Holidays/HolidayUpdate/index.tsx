import { Container, Conteudo, Header } from "styles/global";
import Alterar from "../../../components/UpdateModal";
import { useParams } from "react-router-dom";
import { useState, useEffect } from "react";
import api from "services/api";

export default function HolidayUpdate() {
  const { idFeriado } = useParams();
  const [listagem, setListagem]: any = useState([]);
  const [data, setData] = useState('');
  const [nome, setFeriado] = useState('');

  useEffect(() => {
    api
      .post("/feriados/listar-id", {
        idFeriado
      })
      .then((response) => setListagem(response.data));

  }, []);

  return (
      <Header>
        <Conteudo>
          <div>
            <h2>Alterar Feriado</h2>
            <input
              type="text"
              defaultValue={listagem.nome}
              placeholder="Nome do feriado"
              onChange={e => setFeriado(e.target.value)}
              required
            />
            <input
              type="date"
              defaultValue={listagem.data}
              onChange={e => setData(e.target.value)}
              required
            />
          </div>
          <Alterar 
          modulo="feriados"
          dados={{id:idFeriado,data,nome}}
          />
        </Conteudo>
      </Header>
  );
}
