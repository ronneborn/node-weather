import Link from "next/link";

export function Footer() {
  return (
    <footer className="mt-12 border-t border-slate-200 py-8 text-sm dark:border-slate-800">
      <div className="container flex flex-wrap gap-4 text-slate-500">
        <Link href="/privacy-policy">Privacy Policy</Link>
        <Link href="/terms">Terms</Link>
        <Link href="/disclaimer">Disclaimer</Link>
        <Link href="/rss.xml">RSS</Link>
      </div>
    </footer>
  );
}
