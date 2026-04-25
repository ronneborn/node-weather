import Link from "next/link";
import { prisma } from "@/lib/prisma";

export default async function CategoryPage({ params }: { params: { slug: string } }) {
  const category = await prisma.blogCategory.findUnique({ where: { slug: params.slug }, include: { posts: { include: { post: true } } } });
  if (!category) return <p>Not found.</p>;
  return <div className="space-y-4"><h1 className="text-3xl font-bold">Category: {category.name}</h1>{category.posts.map((p) => <Link key={p.postId} href={`/blog/${p.post.slug}`} className="block card">{p.post.title}</Link>)}</div>;
}
