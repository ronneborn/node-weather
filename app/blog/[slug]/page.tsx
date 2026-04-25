import { notFound } from "next/navigation";
import { prisma } from "@/lib/prisma";

export default async function BlogPostPage({ params }: { params: { slug: string } }) {
  const post = await prisma.blogPost.findUnique({ where: { slug: params.slug }, include: { author: true } });
  if (!post || post.status !== "PUBLISHED") return notFound();
  return <article className="prose max-w-none dark:prose-invert"><h1>{post.title}</h1><p>{post.excerpt}</p><div dangerouslySetInnerHTML={{ __html: post.contentHtml }} /></article>;
}
