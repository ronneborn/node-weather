import { MetadataRoute } from "next";
import { prisma } from "@/lib/prisma";

export default async function sitemap(): Promise<MetadataRoute.Sitemap> {
  const base = "https://currecy-converter.com";
  const posts = await prisma.blogPost.findMany({ where: { status: "PUBLISHED" }, select: { slug: true, updatedAt: true } });
  return [
    "", "/convert", "/blog", "/about", "/contact", "/privacy-policy", "/terms", "/disclaimer"
  ].map((path) => ({ url: `${base}${path}`, lastModified: new Date() }))
    .concat(posts.map((p) => ({ url: `${base}/blog/${p.slug}`, lastModified: p.updatedAt })));
}
