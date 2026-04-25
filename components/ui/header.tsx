import Link from "next/link";

export function Header() {
  return (
    <header className="border-b border-slate-200 bg-white/80 backdrop-blur dark:border-slate-800 dark:bg-slate-950/80">
      <div className="container flex h-16 items-center justify-between">
        <Link href="/" className="font-semibold">currecy-converter.com</Link>
        <nav className="flex gap-4 text-sm">
          <Link href="/convert">Convert</Link>
          <Link href="/blog">Blog</Link>
          <Link href="/about">About</Link>
          <Link href="/admin">Admin</Link>
        </nav>
      </div>
    </header>
  );
}
