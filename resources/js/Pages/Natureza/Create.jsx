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
            
        </AuthenticatedLayout>
    )

  }
