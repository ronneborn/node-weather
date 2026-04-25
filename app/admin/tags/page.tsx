import { redirect } from "next/navigation";
import slugify from "slugify";
import { prisma } from "@/lib/prisma";

async function createTag(formData: FormData) {
  "use server";
  const name = String(formData.get("name"));
  await prisma.blogTag.create({ data: { name, slug: slugify(name, { lower: true, strict: true }) } });
  redirect("/admin/tags");
}

export default async function TagsPage() {
  const tags = await prisma.blogTag.findMany();
  return <div className="space-y-4"><form action={createTag} className="card flex gap-2"><input name="name" className="flex-1 rounded-xl border p-2" placeholder="New tag"/><button className="rounded-xl bg-brand-500 px-3 py-2 text-white">Add</button></form>{tags.map((t)=><div className="card" key={t.id}>{t.name}</div>)}</div>;
}
