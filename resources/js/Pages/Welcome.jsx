import React from  "react";

import { Head, Link }  from "@inertiajs/react";

export default function Welcome({ auth }){

    const currentYear = new Date().getFullYear();
    const appName = import.meta.env.VITE_APP_NAME || "Seu Emissor de Notas Fiscais de Produtor Rural ";

    return(
        <>
            <Head title="Home" />

            <div className="bg-gradient-to-r from-green-300 to-green-500
             min-h-screen flex flex-col justify-center
              items-center text-white">
                
                <header className="text-center">
                    <h1 className="text-3xl font-bold mb-6"> Emita suas notas com eficência</h1>

                </header>

                <div className="flex justify-center space-x-4">
                    {auth.user ? (
                            <Link href={route('dashboard')} className="bg-purple-900 hover:bg-purple-700 text-white font-semibold py-2 px-4 rounded transition duration-300">
                                Painel de Controle
                            </Link>
                    ) : (
                        <>
                            <Link href={route('login')} className="bg-purple-500 hover:bg-purple-600 text-white font-semibold py-2 px-4 rounded transition duration-300">
                                Acessar
                            </Link>
                            <Link href={route('register')} className="bg-blue-900 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition duration-300">
                                    Cadastrar
                            </Link>
                        </>
                    )}
                </div>

                <section className="mt-12 flex flex-col md:flex-row justify-center items-center space-y-6 md:space-y-0 md:space-x-6">
                    <div className="bg-white text-black p-6 rounded-lg shadow-lg w-72 text-center">
                        <h3 className="font-bold text-xl mb-4">Nota de Produtor Rural</h3>
                        <p>
                           
                        </p>
                    </div>  

                </section>

                <footer className="mt-16 text-center">
                    {/* Exibe o ano atual e o nome do aplicativo */}
                    <p>@ {currentYear} {appName}. Todos os direitos reservados.</p>
                </footer>

            </div>
        </>
    )
}


