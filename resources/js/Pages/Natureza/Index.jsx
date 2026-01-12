 import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Link } from '@inertiajs/react';

export default function Index() {
    // depois vem via Inertia
    const naturezasMock = [1, 2, 3, 4];

 

    return (
        <AuthenticatedLayout>
            <div className="pb-24">
                <div className="flex items-center justify-between p-4"></div>
                    <h1 className="text-lg font-bold">Naturezas</h1>
                </div>

        </AuthenticatedLayout>
    )
  }