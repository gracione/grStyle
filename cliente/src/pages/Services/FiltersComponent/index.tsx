import React, { ChangeEvent } from "react";
import {
    AdicionarItem,
    Conteudo,
    Header,
  } from "styles/global";
  
interface Filter {
  name: string;
  percentage: number;
}

interface FiltersProps {
  matrix: Filter[][];
  tipoFiltro: string[];
  nomeDoTipoFiltro: (linha: number, event: ChangeEvent<HTMLInputElement>) => void;
  nomeDoFiltro: (linha: number, coluna: number, event: ChangeEvent<HTMLInputElement>) => void;
  porcentagemDoFiltro: (linha: number, coluna: number, event: ChangeEvent<HTMLInputElement>) => void;
  adicionarLinha: (tamanho: number) => void;
  adicionarColuna: (tamanho: number) => void;
}

const FiltersComponent: React.FC<FiltersProps> = ({
  matrix,
  tipoFiltro,
  nomeDoTipoFiltro,
  nomeDoFiltro,
  porcentagemDoFiltro,
  adicionarLinha,
  adicionarColuna,
}) => {
  return (
    <fieldset>
      <h4>Filtro</h4>
      {matrix.map((row: Filter[], index: number) => (
        <div className="p-1" key={index}>
          <input
            className="inputTable"
            placeholder="Nome do filtro"
            onChange={(e) => nomeDoTipoFiltro(index, e)}
          />
          {row.map((filter: Filter, filterIndex: number) => (
            <div className="display-flex" key={filterIndex}>
              <input
                className="inputTable"
                placeholder="Filtro"
                type="text"
                onChange={(e) => nomeDoFiltro(index, filterIndex, e)}
              />
              <input
                className="inputTable"
                placeholder="Porcentagem"
                type="number"
                onChange={(e) => porcentagemDoFiltro(index, filterIndex, e)}
              />
            </div>
          ))}
          <div className="inputTable" onClick={() => adicionarLinha(index)}>
            +
          </div>
        </div>
      ))}
      <AdicionarItem onClick={() => adicionarColuna(matrix.length)}>
        +
      </AdicionarItem>
    </fieldset>
  );
};

export default FiltersComponent;
