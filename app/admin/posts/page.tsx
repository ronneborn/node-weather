import Link from "next/link";
import { prisma } from "@/lib/prisma";

export default async function AdminPostsPage() {
  const posts = await prisma.blogPost.findMany({ orderBy: { updatedAt: "desc" } });
  return (
    <div className="space-y-4">
      <div className="flex items-center justify-between"><h1 className="text-2xl font-bold">Posts</h1><Link className="rounded-xl bg-brand-500 px-3 py-2 text-white" href="/admin/posts/new">New Post</Link></div>
      {posts.map((post) => <Link className="block card" key={post.id} href={`/admin/posts/${post.id}`}>{post.title} · {post.status}</Link>)}
    </div>
  );
}
