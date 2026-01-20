 import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
 import { useForm } from 'react-hook-form';
 import EmptyState from './Partials/EmptyState'
import { Link } from '@inertiajs/react';

export default function Index({ naturezas }) {
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

 
    if (!naturezas || naturezas.length === 0){
        return (
            <AuthenticatedLayout>
               <EmptyState />
            </AuthenticatedLayout>
        )    
    }

    return (
        <AuthenticatedLayout>

        </AuthenticatedLayout>
    )
  }