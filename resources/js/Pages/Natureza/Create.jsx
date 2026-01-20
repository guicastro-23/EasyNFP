import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { useForm } from 'react-hook-form';

export default function Create() { 
    const {
        register,
        handleSubmit,
        watch,
        formState: { errors },
    } = useForm({
        defaultValues: {
            tpNF: '1', // Saida 
            indDest: '1', // Operação Interna
            indFinal:'0',
            indPres: '1',
        },
    });

    function onSubmit(data) {
        console.log('Naturaza (etapa 1):', data);
    }

    return (
        <AuthenticatedLayout>
            <div className="bg-background-light dark:bg-background-dark min-h-screen flex flex-col">
                <header className="sticky top-0 z-50 border-b border-slate-200 dark:border-[#326748]/30 bg-background-light dark:bg-background-dark/95 backdrop-blur-md">
                    <div className="flex items-center p-4 justify-between max-w-md mx-auto">
                        <button className="size-10 flex items-center justify-center">
                            <span className="material-symbols-outlined">arrow_back_ios</span>
                        </button>
                        <h2 className="text-lg font-bold text-center flex-1 pr-10">
                            Criar Natureza
                        </h2>
                    </div>
                </header>
            </div>
        </AuthenticatedLayout>
    )

  }
