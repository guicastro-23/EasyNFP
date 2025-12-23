import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Link } from '@inertiajs/react';

export default function Index({ notas }) {
    return (
         <AuthenticatedLayout>
            <div>
                <Link
                    href="#"
                    className='mb-4 inline-block px-4 py-2 bg-blue-600 text-white rounded'
                >
                   <span>+</span> Novo Pedido
                </Link>
            </div>
         </AuthenticatedLayout>
    );
}