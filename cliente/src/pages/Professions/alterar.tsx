import { Container, Conteudo, Header } from "styles/global";
import Alterar from "../../components/UpdateModal";
import { useState, useEffect } from "react";
import api from "services/api";
import { useParams } from "react-router-dom";

export default function AlterarProfissao() {
  const [nome, setNome] = useState("");
  const [listagem, setListagem]: any = useState([]);
  const { idProfissao } = useParams();

  useEffect(() => {
    api
    .get("/profissao/"+idProfissao)
      .then((response) => setListagem(response.data));
  }, []);

  return (
    <Header>
      <Conteudo>
        <div>
          <h3>Alterar Profissão</h3>
          <small>Nome</small>
          <input
            name="nome"
            placeholder="..."
            defaultValue={listagem.profissao}
            onChange={(e) => setNome(e.target.value)}
            required
          />
        </div>
        <Alterar modulo="profissao" dados={{ id: idProfissao, nome }} />
      </Conteudo>
    </Header>
  );
}
