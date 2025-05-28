import { useForm } from '@inertiajs/react';
import { useState } from 'react';

export default function EmpresaForm() {
  const [tipoPessoa, setTipoPessoa] = useState('cnpj');

  const { data, setData, post, processing, errors } = useForm({
    tipo_pessoa: 'cnpj',
    cnpj: '',
    razao_social: '',
    nome_fantasia: '',
    cpf: '',
    nome: '',
    inscricao_estadual: '',
    inscricao_municipal: '',
    email: '',
    fone: '',
    cep: '',
    logradouro: '',
    numero: '',
    complemento: '',
    bairro: '',
    cidade: '',
    uf: '',
    pais: 'Brasil',
    codigo_municipio: '',
    codigo_pais: '1058'
  });

  const handleSubmit = (e) => {
    e.preventDefault();
    post('/empresa/cadastrar');
  };

  return (
    <div className="max-w-3xl mx-auto p-6 bg-white rounded shadow">
      <h1 className="text-2xl font-bold mb-6">Cadastro de Empresa / Produtor</h1>
      
      {errors && (
        <div className="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
          <h3 className="font-bold">Erros encontrados:</h3>
          <ul className="list-disc pl-5">
            {Object.keys(errors).map((key) => (
              <li key={key}>{errors[key]}</li>
            ))}
          </ul>
        </div>
      )}

      <form onSubmit={handleSubmit} className="space-y-4">
        {/* Tipo de Pessoa */}
        <div>
          <label className="font-semibold">Tipo de Pessoa</label>
          <select
            className="w-full border rounded p-2 mt-1"
            value={tipoPessoa}
            onChange={(e) => {
              setTipoPessoa(e.target.value);
              setData('tipo_pessoa', e.target.value);
            }}
          >
            <option value="cnpj">Pessoa Jurídica (Empresa)</option>
            <option value="cpf">Pessoa Física (Produtor Rural)</option>
          </select>
        </div>

        {/* Campos CNPJ */}
        {tipoPessoa === 'cnpj' && (
          <>
            <div>
              <label>CNPJ</label>
              <input
                type="text"
                className="w-full border rounded p-2"
                value={data.cnpj || ''}
                onChange={(e) => setData('cnpj', e.target.value)}
              />
              {errors.cnpj && <div className="text-red-500">{errors.cnpj}</div>}
            </div>
            <div>
              <label>Razão Social</label>
              <input
                type="text"
                className="w-full border rounded p-2"
                value={data.razao_social || ''}
                onChange={(e) => setData('razao_social', e.target.value)}
              />
              {errors.razao_social && <div className="text-red-500">{errors.razao_social}</div>}
            </div>
            <div>
              <label>Nome Fantasia</label>
              <input
                type="text"
                className="w-full border rounded p-2"
                value={data.nome_fantasia || ''}
                onChange={(e) => setData('nome_fantasia', e.target.value)}
              />
            </div>
          </>
        )}

        {/* Campos CPF */}
        {tipoPessoa === 'cpf' && (
          <>
            <div>
              <label>CPF</label>
              <input
                type="text"
                className="w-full border rounded p-2"
                value={data.cpf || ''}
                onChange={(e) => setData('cpf', e.target.value)}
              />
              {errors.cpf && <div className="text-red-500">{errors.cpf}</div>}
            </div>
            <div>
              <label>Nome</label>
              <input
                type="text"
                className="w-full border rounded p-2"
                value={data.nome || ''}
                onChange={(e) => setData('nome', e.target.value)}
              />
              {errors.nome && <div className="text-red-500">{errors.nome}</div>}
            </div>
          </>
        )}

        <div>
          <label>Inscrição Estadual</label>
          <input
            type="text"
            className="w-full border rounded p-2"
            value={data.inscricao_estadual || ''}
            onChange={(e) => setData('inscricao_estadual', e.target.value)}
          />
        </div>

        <div>
          <label>Inscrição Municipal</label>
          <input
            type="text"
            className="w-full border rounded p-2"
            value={data.inscricao_municipal || ''}
            onChange={(e) => setData('inscricao_municipal', e.target.value)}
          />
        </div>

        {/* Contato */}
        <div>
          <label>Email</label>
          <input
            type="email"
            className="w-full border rounded p-2"
            value={data.email || ''}
            onChange={(e) => setData('email', e.target.value)}
          />
          {errors.email && <div className="text-red-500">{errors.email}</div>}
        </div>

        <div>
          <label>Telefone</label>
          <input
            type="text"
            className="w-full border rounded p-2"
            value={data.fone || ''}
            onChange={(e) => setData('fone', e.target.value)}
          />
        </div>

        {/* Endereço */}
        <div>
          <label>CEP</label>
          <input
            type="text"
            className="w-full border rounded p-2"
            value={data.cep || ''}
            onChange={(e) => setData('cep', e.target.value)}
          />
          {errors.cep && <div className="text-red-500">{errors.cep}</div>}
        </div>

        <div>
          <label>Logradouro</label>
          <input
            type="text"
            className="w-full border rounded p-2"
            value={data.logradouro || ''}
            onChange={(e) => setData('logradouro', e.target.value)}
          />
          {errors.logradouro && <div className="text-red-500">{errors.logradouro}</div>}
        </div>

        <div>
          <label>Número</label>
          <input
            type="text"
            className="w-full border rounded p-2"
            value={data.numero || ''}
            onChange={(e) => setData('numero', e.target.value)}
          />
        </div>

        <div>
          <label>Complemento</label>
          <input
            type="text"
            className="w-full border rounded p-2"
            value={data.complemento || ''}
            onChange={(e) => setData('complemento', e.target.value)}
          />
        </div>

        <div>
          <label>Bairro</label>
          <input
            type="text"
            className="w-full border rounded p-2"
            value={data.bairro || ''}
            onChange={(e) => setData('bairro', e.target.value)}
          />
          {errors.bairro && <div className="text-red-500">{errors.bairro}</div>}
        </div>

        <div>
          <label>Cidade</label>
          <input
            type="text"
            className="w-full border rounded p-2"
            value={data.cidade || ''}
            onChange={(e) => setData('cidade', e.target.value)}
          />
          {errors.cidade && <div className="text-red-500">{errors.cidade}</div>}
        </div>

        <div>
          <label>UF</label>
          <input
            type="text"
            className="w-full border rounded p-2"
            value={data.uf || ''}
            onChange={(e) => setData('uf', e.target.value)}
          />
          {errors.uf && <div className="text-red-500">{errors.uf}</div>}
        </div>

        <div>
          <label>País</label>
          <input
            type="text"
            className="w-full border rounded p-2"
            value={data.pais || 'Brasil'}
            onChange={(e) => setData('pais', e.target.value)}
          />
        </div>

        <div>
          <label>Código do Município (IBGE)</label>
          <input
            type="text"
            className="w-full border rounded p-2"
            value={data.codigo_municipio || ''}
            onChange={(e) => setData('codigo_municipio', e.target.value)}
          />
          {errors.codigo_municipio && <div className="text-red-500">{errors.codigo_municipio}</div>}
        </div>

        <div>
          <label>Código do País</label>
          <input
            type="text"
            className="w-full border rounded p-2"
            value={data.codigo_pais || '1058'}
            onChange={(e) => setData('codigo_pais', e.target.value)}
          />
        </div>

        <div className="mt-6">
          <button
            type="submit"
            className="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700"
            disabled={processing}
          >
            {processing ? 'Cadastrando...' : 'Cadastrar Empresa'}
          </button>
        </div>
      </form>
    </div>
  );
}