import { prisma } from "@/lib/prisma";

export async function GET() {
  const posts = await prisma.blogPost.findMany({ where: { status: "PUBLISHED" }, take: 20, orderBy: { publishedAt: "desc" } });
  const items = posts.map((p) => `<item><title>${p.title}</title><link>https://currecy-converter.com/blog/${p.slug}</link><description>${p.excerpt}</description></item>`).join("");
  const xml = `<?xml version="1.0"?><rss version="2.0"><channel><title>Currency Converter Blog</title><link>https://currecy-converter.com</link>${items}</channel></rss>`;
  return new Response(xml, { headers: { "content-type": "application/xml" } });
}
