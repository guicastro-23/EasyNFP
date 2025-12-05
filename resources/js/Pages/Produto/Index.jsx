 import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
 import { Link } from '@inertiajs/react';

 export default function Index({ produtos }) {
    return(
        <AuthenticatedLayout>
            <div className='max-w-5xl mx-auto p-4'>
                <Link
                    href="/produto/cadastrar"
                    className='mb-4 inline-block px-4 py-2 bg-blue-600 text-white rounded'
                >
                    Novo Produto
                </Link>

                <table className='w-full border'>
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nome</th>
                            <th>Und.</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </AuthenticatedLayout>
    )

}
