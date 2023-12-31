import api from 'services/api';

export const consultarDados = async (parametros: string): Promise<any> => {
  try {
    const resposta = await api.get(parametros);
    console.log(resposta);
    return resposta.data;
  } catch (erro) {
    console.error('Erro na consulta de dados:', erro);
    throw erro;
  }
};

export const consultar = async (parametros: string): Promise<any> => {
  const resposta = await api.get(parametros);
  return resposta.data;
}

export const inserirDados = async (dados: any): Promise<any> => {
  try {
    const resposta = await api.post('/inserir', dados);
    return resposta.data;
  } catch (erro) {
    console.error('Erro na inserção de dados:', erro);
    throw erro;
  }
};
