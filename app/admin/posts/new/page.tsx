import { redirect } from "next/navigation";
import slugify from "slugify";
import { prisma } from "@/lib/prisma";

async function createPost(formData: FormData) {
  "use server";
  const title = String(formData.get("title") || "Untitled");
  const contentHtml = String(formData.get("contentHtml") || "");
  const excerpt = String(formData.get("excerpt") || "");
  const slug = slugify(title, { lower: true, strict: true });
  const author = await prisma.user.findFirst({ where: { role: "ADMIN" } });
  await prisma.blogPost.create({ data: { title, slug, excerpt, contentHtml, metaTitle: title, metaDescription: excerpt, status: "DRAFT", authorId: author?.id ?? "" } });
  redirect("/admin/posts");
}

export default function NewPostPage() {
  return <form action={createPost} className="card space-y-3"><h1 className="text-2xl font-bold">New Post</h1><input name="title" className="w-full rounded-xl border p-2" placeholder="Title"/><textarea name="excerpt" className="w-full rounded-xl border p-2" placeholder="Excerpt"/><textarea name="contentHtml" className="h-64 w-full rounded-xl border p-2" placeholder="HTML content"/><button className="rounded-xl bg-brand-500 px-4 py-2 text-white">Save Draft</button></form>;
}
