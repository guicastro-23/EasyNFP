import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { useForm } from "@inertiajs/react";

export default function Create() {
    const { data, setData, post, processing, errors } = useForm({
        codigo: "",
        descricao: "",
        tipo_operacao: "saida",
        regime: "ambos",

        icms_incide: true,
        icms_st: false,
        icms_isento: false,
        icms_diferido: false,
        icms_monofasico: false,
        icms_reducao_bc: false,
        icms_gera_credito: false,

        pis_incide: true,
        pis_gera_credito: false,

        cofins_incide: true,
        cofins_gera_credito: false,

        permite_credito_presumido: false,
        credito_presumido_tipo: "",
        credito_presumido_apropriacao: "",

        ibs_incide: false,
        ibs_isento: false,
        ibs_reducao: false,
        gera_credito_ibs: false,

        cbs_incide: false,
        cbs_isento: false,
        cbs_reducao: false,
        gera_credito_cbs: false,

        bloqueia_cst_manual: true,
        exige_ibscbs_xml: false,
        permite_valor_zero: false,
    });

    function submit(e) {
        e.preventDefault();
        post("/classificacoes");
    }

    return (
        <AuthenticatedLayout>
            <div className="bg-background-light dark:bg-background-dark min-h-screen">
                <form
                    onSubmit={submit} 
                    className="max-w-3xl mx-auto p-6 space-y-5"
                >
                    <div
                    className="
                        rounded-xl 
                        bg-slate-50 
                        p-6 
                        space-y-8
                        border
                        dark:bg-slate-900
                        dark:border-slate-700
                    ">
                        
                        <div className="flex flex-col gap-1 p-1 max-w-3xl mx-auto">
                            <h3 className="font-semibold text-base text-gray-900 dark:text-gray-100">
                                Nova Classificação Tributária
                            </h3>
                        </div>
                        <section className="space-y-4">
                            <div>
                                <label className="text-sm font-medium text-gray-900 dark:text-gray-100 " >
                                    Descrição
                                </label>
                                <input
                                    type="text"
                                    className="mt-1 w-full rounded-md border p-2 bg-transparent"
                                    value={data.descricao}
                                    onChange={(e) =>
                                        setData("descricao", e.target.value)
                                    }
                                />
                                {errors.descricao && (
                                    <div className="text-red-500 text-sm">
                                        {errors.descricao}
                                    </div>
                                )}
                            </div>

                            <div className="grid grid-cols-2 gap-4">
                                <div>
                                    <label className="text-sm  text-gray-900 dark:text-gray-100">
                                        Tipo da Operação
                                    </label>
                                    <select
                                         className="mt-1 w-full rounded-md border p-2 bg-transparent text-gray-900 dark:text-gray-400 "
                                        value={data.tipo_operacao}
                                        onChange={(e) =>
                                            setData("tipo_operacao", e.target.value)
                                        }
                                    >
                                        <option value="entrada">Entrada</option>
                                        <option value="saida">Saída</option>
                                        <option value="ambos">Ambos</option>
                                    </select>
                                </div>

                                <div>
                                    <label className="text-sm font-medium text-gray-900 dark:text-gray-100">
                                        Regime
                                    </label>
                                    <select
                                        className="mt-1 w-full rounded-md border p-2 bg-transparent text-gray-900 dark:text-gray-400"
                                        value={data.regime}
                                        onChange={(e) =>
                                            setData("regime", e.target.value)
                                        }
                                    >
                                        <option value="simples">Simples</option>
                                        <option value="normal">Normal</option>
                                        <option value="ambos">Ambos</option>
                                    </select>
                                </div>
                            </div>
                        </section>

                        {/* ICMS */}
                        <section className="space-y-4 border-t pt-3">
                            <h3 className="font-semibold text-base text-gray-900 dark:text-gray-100 " >
                                ICMS
                            </h3>

                            {[
                                "icms_incide",
                                "icms_st",
                                "icms_isento",
                                "icms_diferido",
                                "icms_monofasico",
                                "icms_reducao_bc",
                                "icms_gera_credito",
                            ].map((field) => (
                                <label key={field} className="text-sm text-gray-900 dark:text-gray-100">
                                    <input
                                        type="checkbox"
                                        checked={data[field]}
                                        onChange={(e) =>
                                            setData(field, e.target.checked)
                                        }
                                    />
                                    {field}
                                </label>
                            ))}
                        </section>

                        {/* PIS / COFINS */}
                        <section className="space-y-4 border-t pt-3">
                            <h3 className="font-semibold text-base text-gray-900 dark:text-gray-100 " >
                                PIS / COFINS
                            </h3>

                            <label className="font-semibold text-base text-gray-900 dark:text-gray-100 ">
                                <input
                                    type="checkbox"
                                    checked={data.pis_incide}
                                    onChange={(e) =>
                                        setData("pis_incide", e.target.checked)
                                    }
                                />
                                PIS Incide
                            </label>

                            <label className="font-semibold text-base text-gray-900 dark:text-gray-100 ">
                                <input
                                    type="checkbox"
                                    checked={data.pis_gera_credito}
                                    onChange={(e) =>
                                        setData("pis_gera_credito", e.target.checked)
                                    }
                                />
                                PIS Gera Crédito
                            </label>

                            <label className="font-semibold text-base text-gray-900 dark:text-gray-100 ">
                                <input
                                    type="checkbox"
                                    checked={data.cofins_incide}
                                    onChange={(e) =>
                                        setData("cofins_incide", e.target.checked)
                                    }
                                />
                                COFINS Incide
                            </label>

                            <label className="font-semibold text-base text-gray-900 dark:text-gray-100 ">
                                <input
                                    type="checkbox"
                                    checked={data.cofins_gera_credito}
                                    onChange={(e) =>
                                        setData("cofins_gera_credito", e.target.checked)
                                    }
                                />
                                COFINS Gera Crédito
                            </label>
                        </section>

                        {/* BOTÃO */}
                        <section className="flex justify-end pt-1">
                            <button
                                type="submit"
                                disabled={processing}
                                 className="
                                    w-full
                                    md:w-auto
                                    md:ml-auto
                                    px-6
                                    py-2
                                    rounded-md
                                    bg-emerald-600
                                    text-white"
                            >
                                Salvar
                            </button>
                        </section>
                        
                    </div>
                </form>
            </div>
        </AuthenticatedLayout>
    );
}
