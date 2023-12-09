import { useState,useEffect } from "react";
import Inserir from "../../components/SaveModal";
import api from "services/api";

interface Profissao {
  id: number;
  profissao: string;
}

export default function InserirTratamento() {
  const [tratamento, setTratamento] = useState("");
  const [tempoGasto, setTempoGasto] = useState("");
  const [idProfissao, setIdProfissao] = useState("");
  const [profissoes, setProfissoes] = useState([]);

  useEffect(() => {
    api.get("/profissao").then((response) => setProfissoes(response.data));
  }, []);

  return (
    <>
      <div>
        <input
          placeholder="Tratamento"
          value={tratamento}
          onChange={(e) => setTratamento(e.target.value)}
          required
        />
        <input
          placeholder="Tempo Gasto"
          type="time"
          onChange={(e) => setTempoGasto(e.target.value)}
          required
        />
        <select onChange={(e) => setIdProfissao(e.target.value)} required>
          <option value={0}>Escolha a Profissão</option>
          {profissoes.map((element: Profissao) => (
            <option key={element.id} value={element.id}>{element.profissao}</option>
          ))}
        </select>
      </div>
      
      <Inserir
        modulo="servicos-profissao"
        dados={{
          tratamento,
          tempoGasto,
          idProfissao,
        }}
      />
    </>
  );
}
