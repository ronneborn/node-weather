import Link from "next/link";

export default function AdminLayout({ children }: { children: React.ReactNode }) {
  return (
    <div className="grid gap-6 md:grid-cols-[220px_1fr]">
      <aside className="card h-fit space-y-2 text-sm">
        <Link href="/admin">Dashboard</Link>
        <Link href="/admin/posts">Posts</Link>
        <Link href="/admin/categories">Categories</Link>
        <Link href="/admin/tags">Tags</Link>
        <Link href="/admin/faqs">FAQs</Link>
        <Link href="/admin/pair-content">Pair Content</Link>
        <Link href="/admin/settings">Settings</Link>
      </aside>
      <section>{children}</section>
    </div>
  );
}
