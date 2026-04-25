import Link from "next/link";
import { prisma } from "@/lib/prisma";

export default async function BlogPage() {
  const posts = await prisma.blogPost.findMany({ where: { status: "PUBLISHED" }, orderBy: { publishedAt: "desc" }, include: { categories: { include: { category: true } } } });
  return (
    <div className="space-y-6">
      <h1 className="text-3xl font-bold">Blog</h1>
      {posts.map((post) => <article key={post.id} className="card"><Link href={`/blog/${post.slug}`} className="text-xl font-semibold">{post.title}</Link><p className="mt-2 text-slate-500">{post.excerpt}</p></article>)}
    </div>
  );
}
