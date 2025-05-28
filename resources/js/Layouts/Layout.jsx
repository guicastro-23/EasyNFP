export default function Layout({children}) {
    return (
        <> 
            <header>
                <nav>
                    <a className="nav-link" href="">Home</a>
                    <a href="">Create</a>
                </nav>
            </header>

            <main>
                {children}
            </main>
        </>
    )
    
}