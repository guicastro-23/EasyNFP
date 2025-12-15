import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { useForm } from "@inertiajs/react";
import { useEffect } from "react";

export default function Create() {
    const { data, setData, post, processing, errors } = useForm({
        cProd: '',
        xProd: '',
        cEAN: 'SEM GTIN',
        cEANTrib: 'SEM GTIN',
        ncm: '',
        cest: '',
        uCom: '',
        uTrib: '',
    });

    // 🔹 REGRA ERP: se unidade comercial = tributável, GTIN tributável = GTIN
    useEffect(() => {
        if (data.uCom && data.uTrib && data.uCom === data.uTrib) {
            setData('cEANTrib', data.cEAN || 'SEM GTIN');
        }
    }, [data.uCom, data.uTrib, data.cEAN]);

    const handleSubmit = (e) => {
        e.preventDefault();
        post('/produto/cadastrar');
    };

    return (
        <AuthenticatedLayout>
            <div className="max-w-4xl mx-auto p-6 bg-white rounded shadow">
                <h1 className="text-2xl font-bold mb-6">Cadastro de Produto</h1>

                <form onSubmit={handleSubmit} className="space-y-4">

                    {/* Código do Produto */}
                    <div>
                        <label className="block font-medium">
                            Código (SKU) <span className="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            value={data.cProd}
                            onChange={(e) => setData('cProd', e.target.value)}
                            className="w-full border rounded p-2"
                        />
                        {errors.cProd && <p className="text-red-500 text-sm">{errors.cProd}</p>}
                    </div>

                    {/* Descrição */}
                    <div>
                        <label className="block font-medium">
                            Descrição <span className="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            value={data.xProd}
                            onChange={(e) => setData('xProd', e.target.value)}
                            className="w-full border rounded p-2"
                        />
                        {errors.xProd && <p className="text-red-500 text-sm">{errors.xProd}</p>}
                    </div>

                    {/* GTIN Comercial */}
                    <div>
                        <label className="block font-medium">GTIN (cEAN)</label>
                        <input
                            type="text"
                            value={data.cEAN}
                            onChange={(e) => setData('cEAN', e.target.value)}
                            className="w-full border rounded p-2"
                        />
                        {errors.cEAN && <p className="text-red-500 text-sm">{errors.cEAN}</p>}
                    </div>

                    {/* NCM */}
                    <div>
                        <label className="block font-medium">
                            NCM <span className="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            maxLength={8}
                            value={data.ncm}
                            onChange={(e) => setData('ncm', e.target.value)}
                            className="w-full border rounded p-2"
                        />
                        {errors.ncm && <p className="text-red-500 text-sm">{errors.ncm}</p>}
                    </div>

                    {/* CEST */}
                    <div>
                        <label className="block font-medium">CEST</label>
                        <input
                            type="text"
                            value={data.cest}
                            onChange={(e) => setData('cest', e.target.value)}
                            className="w-full border rounded p-2"
                        />
                        {errors.cest && <p className="text-red-500 text-sm">{errors.cest}</p>}
                    </div>

                    {/* Unidade Comercial */}
                    <div>
                        <label className="block font-medium">
                            Unidade Comercial <span className="text-red-500">*</span>
                        </label>
                        <select
                            value={data.uCom}
                            onChange={(e) => setData('uCom', e.target.value)}
                            className="w-full border rounded p-2"
                        >
                            <option value="">Selecione</option>
                            <option value="UN">Unidade</option>
                            <option value="KG">Quilo</option>
                            <option value="SC">Saco</option>
                            <option value="CX">Caixa</option>
                        </select>
                        {errors.uCom && <p className="text-red-500 text-sm">{errors.uCom}</p>}
                    </div>

                    {/* Unidade Tributável */}
                    <div>
                        <label className="block font-medium">
                            Unidade Tributável <span className="text-red-500">*</span>
                        </label>
                        <select
                            value={data.uTrib}
                            onChange={(e) => setData('uTrib', e.target.value)}
                            className="w-full border rounded p-2"
                        >
                            <option value="">Selecione</option>
                            <option value="UN">Unidade</option>
                            <option value="KG">Quilo</option>
                            <option value="SC">Saco</option>
                            <option value="CX">Caixa</option>
                        </select>
                        {errors.uTrib && <p className="text-red-500 text-sm">{errors.uTrib}</p>}
                    </div>

                    {/* GTIN Tributável — só aparece se necessário */}
                    {data.uCom && data.uTrib && data.uCom !== data.uTrib && (
                        <div>
                            <label className="block font-medium">
                                GTIN Tributável (somente se diferente)
                            </label>
                            <input
                                type="text"
                                value={data.cEANTrib}
                                onChange={(e) => setData('cEANTrib', e.target.value)}
                                className="w-full border rounded p-2"
                            />
                            {errors.cEANTrib && (
                                <p className="text-red-500 text-sm">{errors.cEANTrib}</p>
                            )}
                        </div>
                    )}

                    {/* Botão */}
                    <div className="flex justify-end">
                        <button
                            type="submit"
                            disabled={processing}
                            className="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 disabled:opacity-50"
                        >
                            {processing ? 'Salvando...' : 'Salvar'}
                        </button>
                    </div>

                </form>
            </div>
        </AuthenticatedLayout>
    );
}
