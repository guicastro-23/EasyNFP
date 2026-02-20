import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { useForm } from "react-hook-form";
import { router } from "@inertiajs/react";

export default function Create({ classificacoes = [], cfops = [] }) {
    const {
        register,
        handleSubmit,
        watch,
        formState: { errors },
    } = useForm({
        defaultValues: {
            tpNF: "1",
            finNFe: "1",
            idDest: "1",
            indFinal: "0",
            indPres: "1",
            status: "rascunho",
            ativo: true,
        },
    });

    function onSubmit(data, action = "rascunho") {
        router.post("/naturezas", {
            ...data,
            status: action,
        });
    }

    return (
        <AuthenticatedLayout>
            <div className="bg-background-light dark:bg-background-dark min-h-screen">

                <form
                    onSubmit={handleSubmit((data) => onSubmit(data, "rascunho"))}
                    className="max-w-3xl mx-auto p-6 space-y-8"
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
                    "
                    >
                        <div className="flex flex-col gap-1 p-1 max-w-3xl mx-auto">
                            <h3 className="font-semibold text-base text-gray-900 dark:text-gray-100">
                                Nova Natureza de Operação
                            </h3>
                        </div>
                        <section className="space-y-4">
                            <div>
                                <label className="text-sm font-medium text-gray-900 dark:text-gray-100 ">
                                    Natureza da Operação
                                </label>
                                <input
                                    type="text"
                                    className="mt-1 w-full rounded-md border p-2 bg-transparent"
                                    {...register("natOp", {
                                        required: "Campo obrigatório",
                                        maxLength: 60,
                                    })}
                                />
                                {errors.natOp && (
                                    <p className="text-red-500 text-sm">
                                        {errors.natOp.message}
                                    </p>
                                )}
                            </div>

                            <div>
                            <label className="text-sm font-medium text-gray-900 dark:text-gray-100">
                                Descrição
                            </label>
                            <input
                                type="text"
                                className="mt-1 w-full rounded-md border p-2 bg-transparent"
                                {...register("descricao_interna")}
                            />
                            </div>

                            <div className="grid grid-cols-2 gap-4">
                                <div>
                                    <label className="text-sm text-gray-900 dark:text-gray-100">Tipo da NF-e</label>
                                    <select
                                        className="mt-1 w-full rounded-md border p-2 bg-transparent text-gray-900 dark:text-gray-400 "
                                        {...register("tpNF")}
                                    >
                                        <option value="1">Saída</option>
                                        <option value="0">Entrada</option>
                                    </select>
                                </div>

                                <div>
                                    <label className="text-sm text-gray-900 dark:text-gray-100">
                                        Finalidade da NF-e
                                    </label>
                                    <select
                                        className="mt-1 w-full rounded-md border p-2 bg-transparent text-gray-900 dark:text-gray-400"
                                        {...register("finNFe")}
                                    >
                                        <option value="1">Normal</option>
                                        <option value="2">Complementar</option>
                                        <option value="3">Ajuste</option>
                                        <option value="4">Devolução</option>
                                    </select>
                                </div>
                            </div>
                        </section>

                        {/* DESTINO */}
                        <section className="space-y-4 border-t pt-3">
                            <h3 className="font-semibold text-base text-gray-900 dark:text-gray-100 ">
                                Destino da Operação
                            </h3> 

                            <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div className="flex flex-col gap-1">
                                    <label className="text-xs sm:text-sm text-gray-900 dark:text-gray-100">
                                        Destino
                                    </label>
                                    <select
                                        className="h-10 w-full rounded-md border p-2 bg-transparent text-gray-900 dark:text-gray-400"
                                        {...register("idDest")}
                                    >
                                        <option value="1">Interna</option>
                                        <option value="2">Interestadual</option>
                                        <option value="3">Exterior</option>
                                    </select>
                                </div>
                                <div>
                                    <label className="
                                        text-xs
                                        sm:text-sm
                                        text-gray-900
                                        dark:text-gray-100"
                                    >
                                        Consumidor Final
                                    </label>
                                    <select
                                        className="h-10 w-full rounded-md border p-2 bg-transparent text-gray-900 dark:text-gray-400"
                                        {...register("indFinal")}
                                    >
                                        <option value="0">Não</option>
                                        <option value="1">Sim</option>
                                    </select>
                                </div>
                                <div className="flex flex-col gap-1">
                                    <label className="text-xs sm:text-sm text-gray-900 dark:text-gray-100">
                                        Indicador de Presença
                                    </label>
                                    <select
                                        className="h-10 w-full rounded-md border p-2 bg-transparent text-gray-900 dark:text-gray-400"
                                        {...register("indPres")}
                                    >
                                        <option value="1">Presencial</option>
                                        <option value="2">Internet</option>
                                        <option value="0">Não se aplica</option>
                                        <option value="9">Outros</option>
                                    </select>
                                </div>
                            </div>  
                        </section>
                        
                         {/* CONFIGURAÇÃO FISCAL */}
                        <section className="space-y-4 border-t pt-3">
                           
                            <h3 className="font-semibold text-base text-gray-900 dark:text-gray-100 ">
                                Configuração Fiscal
                            </h3>
                            
                            
                            <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div className="flex flex-col gap-1">
                                    <label className="text-xs sm:text-sm text-gray-900 dark:text-gray-100">
                                        CFOP base
                                    </label>
                                    <select
                                        className="h-10 w-full rounded-md border p-2 bg-transparent text-gray-900 dark:text-gray-400"
                                        {...register("cfop_codigo")}
                                    >
                                        <option value="">Selecione</option>
                                        {cfops.map((cfop) => (
                                            <option
                                                key={cfop.codigo}
                                                value={cfop.codigo}
                                            >
                                                {cfop.codigo} - {cfop.descricao}
                                            </option>
                                        ))}
                                    </select>
                                </div>
                                <div className="flex flex-col gap-1">
                                    <label className="text-xs sm:text-sm text-gray-900 dark:text-gray-100">
                                        Classificação Tributária
                                    </label>
                                    <select
                                        className="h-10 w-full rounded-md border p-2 bg-transparent text-gray-900 dark:text-gray-400"
                                        {...register("classificacao_tributaria_id")}
                                    >
                                        <option value="">Selecione</option>
                                        {classificacoes.map((c) => (
                                            <option key={c.id} value={c.id}>
                                                {c.codigo} - {c.descricao}
                                            </option>
                                        ))}
                                    </select>
                                </div>
                            </div>   
                        </section>

                        {/*  AÇÕES */}
                        <section className="flex justify-end pt-1">
                            <button
                                type="submit"
                                onClick={handleSubmit((data) =>
                                    onSubmit(data, "ativa")
                                )}
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
