import Link from "next/link";
import { prisma } from "@/lib/prisma";

export default async function TagPage({ params }: { params: { slug: string } }) {
  const tag = await prisma.blogTag.findUnique({ where: { slug: params.slug }, include: { posts: { include: { post: true } } } });
  if (!tag) return <p>Not found.</p>;
  return <div className="space-y-4"><h1 className="text-3xl font-bold">Tag: {tag.name}</h1>{tag.posts.map((p) => <Link key={p.postId} href={`/blog/${p.post.slug}`} className="block card">{p.post.title}</Link>)}</div>;
}
