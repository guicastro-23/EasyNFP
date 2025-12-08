import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { useForm } from "@inertiajs/react";
import {useState} from 'react'

    export default function Create() {
        return (
            <AuthenticatedLayout>
                <div className="">
                    <h1> Cadastro</h1>
                    <form >
                        <div>
                            <label> Código </label>
                        </div>
                    </form>
                </div>
            </AuthenticatedLayout>
        );
    }