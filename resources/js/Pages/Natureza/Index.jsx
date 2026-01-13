 import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
 import { useForm } from 'react-hook-form';
import { Link } from '@inertiajs/react';

export default function Index() {
    const {
        register,
        handleSubmit,
        watch,
    } = useForm({
        defaultValues: {
            search: '',
        },
    });

    const searchValue = watch('search');

    function onSubmit(data) {
        // por enquanto só visual / debug
        console.log('Filtro aplicado:', data);
    }

 

    return (
        <AuthenticatedLayout>
            <div className="pb-24">
                {/* Header */}
                <div className="flex items-center justify-between p-4">
                    <h1 className="text-lg font-bold">Naturezas</h1>

                    <a
                        href="/naturezas/create"
                        className="bg-primary text-white rounded-lg px-4 py-2 text-sm font-semibold hover:bg-primary/90"
                    >
                    Nova Natureza
                    </a>
                </div>


                 <div className="p-6">
                <div className="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <p className="text-gray-400 text-xs mt-2">
                         Clique em <strong>“Nova Natureza”</strong> para começar.
                    </p>
                </div>
            </div> 
            </div>

        </AuthenticatedLayout>
    )
  }