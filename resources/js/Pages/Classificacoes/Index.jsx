import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";

export default function Index({ classificacoes }) {
    return (
        <AuthenticatedLayout>
            <div className="max-w-5xl mx-auto p-6 space-y-6">
                <h2 className="text-2xl font-bold">
                    Classificações Tributárias
                </h2>

                {classificacoes.map((c) => (
                    <div
                        key={c.id}
                        className="border rounded-lg p-4 bg-white dark:bg-slate-900"
                    >
                        <h2 className="text-lg font-semibold">
                            {c.descricao}
                        </h2>

                        <div className="mt-2 text-sm space-y-1">
                            <p>
                                <strong>Tipo:</strong> {c.tipo_operacao}
                            </p>
                            <p>
                                <strong>Regime:</strong> {c.regime}
                            </p>
                        </div>

                        <div className="mt-3 text-sm">
                            <strong>ICMS:</strong>
                            <ul className="ml-4 list-disc">
                                <li>Incide: {c.icms_incide ? "Sim" : "Não"}</li>
                                <li>ST: {c.icms_st ? "Sim" : "Não"}</li>
                                <li>Isento: {c.icms_isento ? "Sim" : "Não"}</li>
                                <li>Gera crédito: {c.icms_gera_credito ? "Sim" : "Não"}</li>
                            </ul>
                        </div>

                        <div className="mt-3 text-sm">
                            <strong>CST ICMS vinculados:</strong>
                            <ul className="ml-4 list-disc">
                                {c.csts_icms?.map((item) => (
                                    <li key={item.id}>
                                        {item.cst_icms_codigo}
                                    </li>
                                ))}
                            </ul>
                        </div>
                    </div>
                ))}
            </div>
        </AuthenticatedLayout>
    );
}

