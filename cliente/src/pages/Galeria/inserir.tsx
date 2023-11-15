import { useState } from "react";
import Inserir from "../../components/SaveModal";

export default function InserirAlbum() {
  const [nome, setNome] = useState("");

  return (
    <div>
      <input
        placeholder="Nome do Album"
        value={nome}
        onChange={(e) => setNome(e.target.value)}
        required
      />

      <Inserir modulo="galeria" dados={{ nome }} />
    </div>
  );
}
