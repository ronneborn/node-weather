import { prisma } from "@/lib/prisma";

export default async function AdminDashboard() {
  const [posts, categories, tags] = await Promise.all([prisma.blogPost.count(), prisma.blogCategory.count(), prisma.blogTag.count()]);
  return <div className="space-y-4"><h1 className="text-2xl font-bold">Admin Dashboard</h1><div className="grid gap-3 md:grid-cols-3"><div className="card">Posts: {posts}</div><div className="card">Categories: {categories}</div><div className="card">Tags: {tags}</div></div></div>;
}
