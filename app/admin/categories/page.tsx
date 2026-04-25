import { redirect } from "next/navigation";
import slugify from "slugify";
import { prisma } from "@/lib/prisma";

async function createCategory(formData: FormData) {
  "use server";
  const name = String(formData.get("name"));
  await prisma.blogCategory.create({ data: { name, slug: slugify(name, { lower: true, strict: true }) } });
  redirect("/admin/categories");
}

export default async function CategoriesPage() {
  const categories = await prisma.blogCategory.findMany();
  return <div className="space-y-4"><form action={createCategory} className="card flex gap-2"><input name="name" className="flex-1 rounded-xl border p-2" placeholder="New category"/><button className="rounded-xl bg-brand-500 px-3 py-2 text-white">Add</button></form>{categories.map((c)=><div className="card" key={c.id}>{c.name}</div>)}</div>;
}
