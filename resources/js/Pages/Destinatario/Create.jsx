import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { useForm } from '@inertiajs/react';
import { useState } from 'react';

export default function Create() {
    const { data, setData, post, processing, errors } = useForm({
        cpf: '',
        cnpj: '',
        id_estrangeiro: '',
        xnome: '',
        ind_ie_dest: '9',
        ie: '',
        isuf: '',
        im: '',
        email: '',
        endereco: {
            xlgr: '',
            nro: '',
            xCpl: '',
            xBairro: '',
            cMun: '',
            xMun: '',
            UF: '',
            CEP: '',
            cPais: '1058',
            xPais: 'Brasil',
            fone: '',
        },
    });
    const [tipoPessoa, setTipoPessoa] = useState('cpf');

    const handleSubmit = (e) => {
        e.preventDefault();
        post('/destinatario/cadastrar');
    };

    return (
        <AuthenticatedLayout>
            <div className="max-w-4xl mx-auto p-6 bg-white rounded shadow">
                <h1 className="text-2xl font-bold mb-6">Cadastro de Destinatário</h1>

                <form onSubmit={handleSubmit} className="space-y-4">
                    <div>
                        <label>Tipo de Pessoa </label>
                        <select
                            className="w-full border rounded p-2"
                            value={tipoPessoa}
                            onChange={(e) => {
                                const tipo = e.target.value;
                                setTipoPessoa(tipo);
                            }}
                        >
                            <option value="cpf">Pessoa Física</option>
                            <option value="cnpj">Pessoa Jurídica</option>
                        </select>
                    </div>

                    {tipoPessoa === 'cpf' && (
                        <div>
                            <label>CPF <span className="text-red-500">*</span></label>
                            <input
                                type="text"
                                maxLength={11}
                                className="w-full border rounded p-2"
                                value={data.cpf}
                                onChange={(e) => setData('cpf', e.target.value)}
                                required
                            />
                            {data.cpf && data.cpf.length !== 11 && (
                                <span className="text-red-500 text-sm">
                                 O CPF deve ter exatamente 11 dígitos.
                            </span>
)}
                        </div>
                    )}

                    {tipoPessoa === 'cnpj' && (
                        <div>
                            <label>CNPJ <span className="text-red-500">*</span></label>
                            <input
                                type="text"
                                maxLength={14}
                                className="w-full border rounded p-2"
                                value={data.cnpj}
                                onChange={(e) => setData('cnpj', e.target.value)}
                                required
                            />
                            {data.cnpj && data.cnpj.length !== 14 && (
                                <span className="text-red-500 text-sm">
                                    O CNPJ deve ter exatamente 14 dígitos.
                                </span>
)}
                        </div>
                    )}



                    <div>
                        <label>Nome / Razão Social <span className="text-red-500">*</span></label>
                        <input
                            type="text"
                            className="w-full border rounded p-2"
                            value={data.xnome}
                            onChange={(e) => setData('xnome', e.target.value)}
                        />
                        {errors.xnome && <div className="text-red-500">{errors.xnome}</div>}
                    </div>

                    <div>
                        <label>Indicador IE <span className="text-red-500">*</span></label>
                        <select
                            className="w-full border rounded p-2"
                            value={data.ind_ie_dest}
                            onChange={(e) => setData('ind_ie_dest', e.target.value)}
                        >
                            <option value="1">1 - Contribuinte ICMS</option>
                            <option value="2">2 - Contribuinte Isento</option>
                            <option value="9">9 - Não Contribuinte</option>
                        </select>
                    </div>

                    {/* IE com obrigatoriedade condicional */}
                    <div>
                        <label>
                            IE {data.ind_ie_dest === '1' && <span className="text-red-500">*</span>}
                        </label>
                        <input
                            type="text"
                            className={`w-full border rounded p-2 ${data.ind_ie_dest === '1' && !data.ie ? 'border-red-500' : ''}`}
                            value={data.ie}
                            onChange={(e) => setData('ie', e.target.value)}
                            required={data.ind_ie_dest === '1'}
                        />
                        {data.ind_ie_dest === '1' && !data.ie && (
                            <div className="text-red-500 text-sm">
                                Campo IE é obrigatório para contribuinte ICMS
                            </div>
                        )}
                    </div>

                    <div>
                        <label>Telefone</label>
                        <input
                            type="tel"
                            className="w-full border rounded p-2"
                            value={data.endereco.fone}
                            onChange={(e) => setData('endereco.fone', e.target.value)}
                        />
                    </div>

                    <div>
                        <label>Email</label>
                        <input
                            type="email"
                            className="w-full border rounded p-2"
                            value={data.email}
                            onChange={(e) => setData('email', e.target.value)}
                        />
                    </div>

                    <hr className="my-4" />
                    <h2 className="text-xl font-semibold mb-2">Endereço</h2>

                    <div className="grid grid-cols-2 gap-4">
                        <div>
                            <label>Logradouro <span className="text-red-500">*</span></label>
                            <input
                                type="text"
                                className="w-full border rounded p-2"
                                value={data.endereco.xlgr}
                                onChange={(e) => setData('endereco.xlgr', e.target.value)}
                                required
                            />
                        </div>
                        <div>
                            <label>Número <span className="text-red-500">*</span></label>
                            <input
                                type="text"
                                className="w-full border rounded p-2"
                                value={data.endereco.nro}
                                onChange={(e) => setData('endereco.nro', e.target.value)}
                                required
                            />
                        </div>
                        <div>
                            <label>Bairro <span className="text-red-500">*</span></label>
                            <input
                                type="text"
                                className="w-full border rounded p-2"
                                value={data.endereco.xBairro}
                                onChange={(e) => setData('endereco.xBairro', e.target.value)}
                                required
                            />
                        </div>
                        <div>
                            <label>Município <span className='text-red-500'>*</span></label>
                            <input
                                type="text"
                                className="w-full border rounded p-2"
                                value={data.endereco.xMun}
                                onChange={(e) => setData('endereco.xMun', e.target.value)}
                                required
                            />
                        </div>
                        <div>
                            <label>Código da Cidade <span className='text-red-500'>*</span></label>
                            <input type="text"
                                className="w-full border rounded p-2" 
                                value={data.endereco.cMun}
                                onChange={(e) => setData('endereco.cMun', e.target.value)}
                                required
                            />
                        </div>
                        <div>
                            <label>UF <span className='text-red-500'>*</span></label>
                            <input
                                type="text"
                                className="w-full border rounded p-2"
                                value={data.endereco.UF}
                                onChange={(e) => setData('endereco.UF', e.target.value.toUpperCase())}
                                required
                            />
                        </div>
                        <div>
                            <label>CEP <span className='text-red-500'>*</span></label>
                            <input
                                type="text"
                                className="w-full border rounded p-2"
                                value={data.endereco.CEP}
                                onChange={(e) => setData('endereco.CEP', e.target.value)}
                            />
                        </div>
                    </div>

                    <div className="mt-6">
                        <button
                            type="submit"
                            className="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700"
                            disabled={processing}
                        >
                            {processing ? 'Salvando...' : 'Cadastrar Destinatário'}
                        </button>
                    </div>
                </form>
            </div>
        </AuthenticatedLayout>
    );
}