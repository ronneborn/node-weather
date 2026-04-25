import { redirect } from "next/navigation";
import { prisma } from "@/lib/prisma";

async function createPairContent(formData: FormData) {
  "use server";
  await prisma.pairContent.create({ data: { fromCurrency: String(formData.get("from")).toUpperCase(), toCurrency: String(formData.get("to")).toUpperCase(), introCopy: String(formData.get("intro")) } });
  redirect("/admin/pair-content");
}

export default async function PairContentPage() {
  const records = await prisma.pairContent.findMany({ orderBy: { updatedAt: "desc" }, take: 50 });
  return <div className="space-y-3"><form className="card space-y-2" action={createPairContent}><div className="grid grid-cols-2 gap-2"><input className="rounded-xl border p-2" name="from" placeholder="USD"/><input className="rounded-xl border p-2" name="to" placeholder="EUR"/></div><textarea className="w-full rounded-xl border p-2" name="intro" placeholder="Intro copy"/><button className="rounded-xl bg-brand-500 px-3 py-2 text-white">Save pair content</button></form>{records.map((r)=><div key={r.id} className="card">{r.fromCurrency}/{r.toCurrency} - {r.introCopy.slice(0,80)}</div>)}</div>;
}
