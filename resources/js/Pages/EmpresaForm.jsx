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
    codigo_pais: '1058',
    crt: '',
    cnae: ''

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
              <label>CNPJ  <span style={{ color: 'red' }}>*</span> </label>
              <input
                type="text"
                className="w-full border rounded p-2"
                value={data.cnpj || ''}
                onChange={(e) => setData('cnpj', e.target.value)}
                required
              />
              {errors.cnpj && <div className="text-red-500">{errors.cnpj}</div>}
            </div>
            <div>
              <label>Nome <span style={{color: 'red'}}>*</span></label> {/* Razão Social  */}
              <input
                type="text"
                className="w-full border rounded p-2"
                value={data.razao_social || ''}
                onChange={(e) => setData('razao_social', e.target.value)}
                required
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
              <label>CPF <span style={{color: 'red'}}>*</span></label>
              <input
                type="text"
                className="w-full border rounded p-2"
                value={data.cpf || ''}
                onChange={(e) => setData('cpf', e.target.value)}
                required
              />
              {errors.cpf && <div className="text-red-500">{errors.cpf}</div>}
            </div>
            <div>
              <label>Nome <span style={{color: 'red'}}>*</span></label>
              <input
                type="text"
                className="w-full border rounded p-2"
                value={data.nome || ''}
                onChange={(e) => setData('nome', e.target.value)}
                required
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
          <label>Email <span style={{color: 'red'}}>*</span></label>
          <input
            type="email"
            className="w-full border rounded p-2"
            value={data.email || ''}
            onChange={(e) => setData('email', e.target.value)}
            required
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
          <label>CEP <span style={{color:'red'}}>*</span></label>
          <input
            type="text"
            className="w-full border rounded p-2"
            value={data.cep || ''}
            onChange={(e) => setData('cep', e.target.value)}
            required
          />
          {errors.cep && <div className="text-red-500">{errors.cep}</div>}
        </div>

        <div>
          <label>Logradouro <span style={{color: 'red'}}>*</span></label>
          <input
            type="text"
            className="w-full border rounded p-2"
            value={data.logradouro || ''}
            onChange={(e) => setData('logradouro', e.target.value)}
            required
          />
          {errors.logradouro && <div className="text-red-500">{errors.logradouro}</div>}
        </div>

        <div>
          <label>Número <span style={{color:'red'}}>*</span></label>
          <input
            type="text"
            className="w-full border rounded p-2"
            value={data.numero || ''}
            onChange={(e) => setData('numero', e.target.value)}
            required
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
          <label>Bairro <span style={{color: 'red'}}>*</span></label>
          <input
            type="text"
            className="w-full border rounded p-2"
            value={data.bairro || ''}
            onChange={(e) => setData('bairro', e.target.value)}
            required
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
          <label>UF <span style={{color:'red'}}>*</span></label>
          <input
            type="text"
            className="w-full border rounded p-2"
            value={data.uf || ''}
            onChange={(e) => setData('uf', e.target.value)}
            required
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
          <label>Código do Município (IBGE) <span style={{color:'red'}}>*</span></label>
          <input
            type="text"
            className="w-full border rounded p-2"
            value={data.codigo_municipio || ''}
            onChange={(e) => setData('codigo_municipio', e.target.value)}
            required
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

        {/* CRT - Código de Regime Tributário */}
        <div>
          <label className="font-semibold">Regime Tributário (CRT)</label>
          <select
            className="w-full border rounded p-2 mt-1"
            value={data.crt || ''}
            onChange={(e) => setData('crt', e.target.value)}
          >
            <option value="">Selecione o regime tributário</option>
            <option value="1">1 - Simples Nacional</option>
            <option value="2">2 - Simples Nacional - excesso de sublimite de receita bruta</option>
            <option value="3">3 - Regime Normal</option>
            <option value="4">4 - Simples Nacional - Microempreendedor individual - MEI</option>
          </select>
          {errors.crt && <div className="text-red-500">{errors.crt}</div>}
        </div>

        {/* CNAE */}
        <div>
          <label className="font-semibold">CNAE (Classificação Nacional de Atividades Econômicas)</label>
          <input
            type="text"
            className="w-full border rounded p-2 mt-1"
            value={data.cnae || ''}
            onChange={(e) => setData('cnae', e.target.value)}
            placeholder="Ex: 5611201"
          />
          {errors.cnae && <div className="text-red-500">{errors.cnae}</div>}
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