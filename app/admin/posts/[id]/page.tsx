import { notFound, redirect } from "next/navigation";
import { prisma } from "@/lib/prisma";

async function updatePost(formData: FormData) {
  "use server";
  const id = String(formData.get("id"));
  await prisma.blogPost.update({ where: { id }, data: { title: String(formData.get("title")), excerpt: String(formData.get("excerpt")), contentHtml: String(formData.get("contentHtml")), status: String(formData.get("status")) as "DRAFT" | "PUBLISHED", publishedAt: String(formData.get("status")) === "PUBLISHED" ? new Date() : null } });
  redirect("/admin/posts");
}

export default async function EditPostPage({ params }: { params: { id: string } }) {
  const post = await prisma.blogPost.findUnique({ where: { id: params.id } });
  if (!post) return notFound();
  return <form action={updatePost} className="card space-y-3"><input type="hidden" name="id" value={post.id} /><input className="w-full rounded-xl border p-2" name="title" defaultValue={post.title} /><textarea className="w-full rounded-xl border p-2" name="excerpt" defaultValue={post.excerpt} /><textarea className="h-64 w-full rounded-xl border p-2" name="contentHtml" defaultValue={post.contentHtml} /><select name="status" defaultValue={post.status} className="rounded-xl border p-2"><option>DRAFT</option><option>PUBLISHED</option></select><button className="rounded-xl bg-brand-500 px-4 py-2 text-white">Update</button></form>;
}
