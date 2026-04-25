import Link from "next/link";
import { ConverterCard } from "@/components/converter/converter-card";
import { popularPairs } from "@/lib/data/currencies";
import { prisma } from "@/lib/prisma";

export default async function HomePage() {
  const posts = await prisma.blogPost.findMany({ where: { status: "PUBLISHED" }, take: 3, orderBy: { publishedAt: "desc" } });
  return (
    <div className="space-y-10">
      <section className="grid items-center gap-8 md:grid-cols-2">
        <div>
          <h1 className="text-4xl font-bold">Live Currency Conversion, Built for Smart Decisions</h1>
          <p className="mt-3 text-slate-600 dark:text-slate-300">Convert instantly, inspect historical trends, and learn how rates actually impact real-world transfers and travel.</p>
        </div>
        <ConverterCard />
      </section>
      <section className="card">
        <h2 className="text-xl font-semibold">Popular Pairs</h2>
        <div className="mt-4 grid grid-cols-2 gap-3 md:grid-cols-3">
          {popularPairs.map(([from, to]) => <Link key={`${from}-${to}`} className="rounded-xl border p-3" href={`/${from.toLowerCase()}-to-${to.toLowerCase()}`}>{from} to {to}</Link>)}
        </div>
      </section>
      <section className="card">
        <h2 className="text-xl font-semibold">From the Blog</h2>
        <div className="mt-4 grid gap-4 md:grid-cols-3">{posts.map((post) => <Link key={post.id} href={`/blog/${post.slug}`} className="rounded-xl border p-4"><h3 className="font-semibold">{post.title}</h3><p className="mt-2 text-sm text-slate-500">{post.excerpt}</p></Link>)}</div>
      </section>
    </div>
  );
}
