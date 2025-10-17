import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Link } from '@inertiajs/react';

export default function Index({ destinatarios }) {
    return (
        <AuthenticatedLayout>
            
            <div className="max-w-5xl mx-auto p-4">
                {/* <h1 className="text-2xl font-bold mb-4">Destinatários</h1> */}

                <Link
                    href="/destinatario/cadastrar"
                    className="mb-4 inline-block px-4 py-2 bg-blue-600 text-white rounded"
                >
                    + Novo Cliente
                </Link>

                <table className="w-full border">
                    <thead>
                        <tr className="bg-gray-100">
                            <th className="p-2 border">Nome</th>
                            <th className="p-2 border">Documento</th>
                            <th className="p-2 border">Cidade</th>
                            <th className="p-2 border">UF</th>
                            <th className="p-2 border">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        {destinatarios.map(dest => (
                            <tr key={dest.id} className="text-center">
                                <td className="border p-2">{dest.xnome}</td>
                                <td className="border p-2">{dest.cnpj || dest.cpf}</td>
                                <td className="border p-2">{dest.endereco?.xMun}</td>
                                <td className="border p-2">{dest.endereco?.UF}</td>
                                <td className="border p-2">{dest.email}</td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            </div>
        </AuthenticatedLayout>
    );
}
