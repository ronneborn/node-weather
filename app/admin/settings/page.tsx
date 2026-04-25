import { redirect } from "next/navigation";
import { prisma } from "@/lib/prisma";

async function saveSetting(formData: FormData) {
  "use server";
  await prisma.siteSetting.upsert({ where: { key: "homepage_headline" }, update: { value: String(formData.get("value")) }, create: { key: "homepage_headline", value: String(formData.get("value")) } });
  redirect("/admin/settings");
}

export default async function SettingsPage() {
  const setting = await prisma.siteSetting.findUnique({ where: { key: "homepage_headline" } });
  return <form action={saveSetting} className="card space-y-2"><h1 className="text-xl font-bold">Site settings</h1><input name="value" defaultValue={setting?.value || ""} className="w-full rounded-xl border p-2"/><button className="rounded-xl bg-brand-500 px-3 py-2 text-white">Save</button></form>;
}
