import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { useForm } from "@inertiajs/react";
import {useState} from 'react'

    export default function Create() {
        const {data, setData, post, processing, errors} = useForm({
            cProd:'',
            xProd:'',
            cEAN:'',
            ncm:'', 
            cEAN:'',
            cEANTrib:'',
            uCom:'',
            uTrib:'',


        })

        const handleSubmit = (e) => {
            e.preventDefault()
            post('/produto/cadastrar')
        };


        return (
            <AuthenticatedLayout>
                <div className="max-w-4x1 mx-auto p-6 bg-white rounded shadow">
                    <h1 className="text-2x1 font-bold mb-6"> Cadastro</h1>
                    <form onSubmit={handleSubmit} className="space-y-4">
                        <div>
                            <label> Código <span className="text-red-500">*</span></label>
                            <input type="text" 
                            className="w-full borden rounded p-2" />
                        </div>
                    </form>
                </div>
            </AuthenticatedLayout>
        );
    }