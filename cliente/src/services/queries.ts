import api from '../services/api';

export const consultarDados = async (parametros: string): Promise<any> => {
  try {
    const resposta = await api.get(parametros);
    return resposta.data;
  } catch (erro) {
    console.error('Erro na consulta de dados:', erro);
    throw erro;
  }
};

export const inserirDados = async (dados: any): Promise<any> => {
  try {
    const resposta = await api.post('/inserir', dados);
    return resposta.data;
  } catch (erro) {
    console.error('Erro na inserção de dados:', erro);
    throw erro;
  }
};
