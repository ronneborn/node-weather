import { redirect } from "next/navigation";
import { prisma } from "@/lib/prisma";

async function createFaq(formData: FormData) {
  "use server";
  await prisma.fAQ.create({ data: { question: String(formData.get("question")), answer: String(formData.get("answer")), scope: "GLOBAL" } });
  redirect("/admin/faqs");
}

export default async function FaqsPage() {
  const faqs = await prisma.fAQ.findMany({ orderBy: { createdAt: "desc" } });
  return <div className="space-y-3"><form className="card space-y-2" action={createFaq}><input className="w-full rounded-xl border p-2" name="question" placeholder="Question"/><textarea className="w-full rounded-xl border p-2" name="answer" placeholder="Answer"/><button className="rounded-xl bg-brand-500 px-3 py-2 text-white">Save FAQ</button></form>{faqs.map((f)=><div key={f.id} className="card"><p className="font-semibold">{f.question}</p><p>{f.answer}</p></div>)}</div>;
}
