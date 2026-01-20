import { Link } from '@inertiajs/react'

export default function EmptyState() {
    return (
        <div className="min-h-[calc(100vh-4rem)] flex flex-col items-center justify-center px-6 text-center">

            <div className="mb-6">
                <div className="w-20 h-20 rounded-2xl bg-primary/10 flex items-center justify-center">
                    <span className="text-primary text-3xl">ICONE</span>
                </div>
            </div>

            <h1 className="text-xl font-bold text-gray-900">
                Nenhuma natureza de operação encontrada
            </h1>

            <p className="text-gray-500 text-sm mt-3 max-w-sm">
                As naturezas de operação definem as regras tributárias para a emissão das suas notas fiscais.
                Comece cadastrando a sua primeira natureza.
            </p>

            <Link
                href="/naturezas/cadastrar"
                className="mt-6 inline-flex items-center gap-2 bg-primary text-white rounded-lg px-6 py-3 text-sm font-semibold hover:bg-primary/90"
            >
                ➕ Cadastrar minha primeira natureza
            </Link>

        </div>
    )
}
