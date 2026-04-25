import { PrismaClient } from "@prisma/client";
import bcrypt from "bcryptjs";

const prisma = new PrismaClient();

const posts = [
  ["Why Currency Rates Change Daily", "why-currency-rates-change-daily"],
  ["Bank Rate vs Market Rate: What You Really Pay", "bank-rate-vs-market-rate"],
  ["How Conversion Fees Quietly Increase Travel Costs", "conversion-fees-travel-costs"],
  ["Best Time to Exchange Money Before a Trip", "best-time-exchange-money"],
  ["Common Currency Mistakes Travelers Make", "currency-mistakes-travelers-make"],
  ["Using Historical Exchange Rates for Budgeting", "historical-rates-for-budgeting"],
  ["How Inflation Affects Currency Value", "inflation-and-currency-value"],
  ["Reference Rate vs Transaction Rate", "reference-rate-vs-transaction-rate"],
  ["International Payments: Hidden Cost Checklist", "international-payments-hidden-costs"],
  ["Managing FX Risk for Small Businesses", "managing-fx-risk-small-business"],
  ["Volatile Currencies Explained in Plain English", "volatile-currencies-explained"],
  ["How to Compare Remittance Providers", "compare-remittance-providers"]
];

async function main() {
  const passwordHash = await bcrypt.hash(process.env.ADMIN_PASSWORD || "ChangeMe123!", 10);
  const admin = await prisma.user.upsert({ where: { email: process.env.ADMIN_EMAIL || "admin@currecy-converter.com" }, update: {}, create: { name: "Admin", email: process.env.ADMIN_EMAIL || "admin@currecy-converter.com", passwordHash, role: "ADMIN" } });

  const categories = await Promise.all(["Exchange Rates", "Travel Money", "Business FX"].map((name) => prisma.blogCategory.upsert({ where: { slug: name.toLowerCase().replace(/\s+/g, "-") }, update: {}, create: { name, slug: name.toLowerCase().replace(/\s+/g, "-") } })));
  const tags = await Promise.all(["fees", "volatility", "travel", "payments", "inflation"].map((name) => prisma.blogTag.upsert({ where: { slug: name }, update: {}, create: { name, slug: name } })));

  for (const [index, [title, slug]] of posts.entries()) {
    const post = await prisma.blogPost.upsert({
      where: { slug },
      update: {},
      create: {
        title,
        slug,
        excerpt: `Practical guide: ${title}.`,
        contentHtml: `<p>${title} matters when you convert money for travel, invoices, payroll, or savings. This article explains real-world factors and smarter choices.</p><h2>Key Takeaways</h2><ul><li>Track mid-market trends.</li><li>Compare provider spreads and fees.</li><li>Use historical rates for timing.</li></ul>`,
        metaTitle: `${title} | Currency Converter Blog`,
        metaDescription: `Learn ${title.toLowerCase()} with practical, no-fluff guidance.`,
        status: "PUBLISHED",
        publishedAt: new Date(Date.now() - index * 86400000),
        authorId: admin.id
      }
    });
    await prisma.blogPostCategory.upsert({ where: { postId_categoryId: { postId: post.id, categoryId: categories[index % categories.length].id } }, update: {}, create: { postId: post.id, categoryId: categories[index % categories.length].id } });
    await prisma.blogPostTag.upsert({ where: { postId_tagId: { postId: post.id, tagId: tags[index % tags.length].id } }, update: {}, create: { postId: post.id, tagId: tags[index % tags.length].id } });
  }

  await prisma.siteSetting.upsert({ where: { key: "homepage_headline" }, update: { value: "Convert smarter with live rates and practical FX insights." }, create: { key: "homepage_headline", value: "Convert smarter with live rates and practical FX insights." } });
}

main().finally(() => prisma.$disconnect());
