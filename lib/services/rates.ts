import { prisma } from "@/lib/prisma";

export type RateQuote = {
  base: string;
  quote: string;
  rate: number;
  asOf: string;
  source: string;
};

export type RatePoint = { date: string; rate: number };

const PRIMARY = process.env.RATE_PROVIDER_URL || "https://api.frankfurter.dev/v1";

async function fetchFrankfurter(url: string) {
  const res = await fetch(url, { next: { revalidate: 900 } });
  if (!res.ok) throw new Error("Rate provider unavailable");
  return res.json();
}

export async function getLatestRate(from: string, to: string): Promise<RateQuote> {
  const key = `${from}-${to}`.toUpperCase();
  const cached = await prisma.rateCache.findUnique({ where: { key } });
  const now = Date.now();

  if (cached && now - cached.fetchedAt.getTime() < 10 * 60 * 1000) {
    return { base: from, quote: to, rate: cached.rate, asOf: cached.asOf.toISOString(), source: cached.source };
  }

  try {
    const json = await fetchFrankfurter(`${PRIMARY}/latest?base=${from}&symbols=${to}`);
    const rate = Number(json.rates[to]);
    const asOf = new Date(json.date);
    await prisma.rateCache.upsert({
      where: { key },
      update: { rate, asOf, source: "Frankfurter", fetchedAt: new Date() },
      create: { key, base: from, quote: to, rate, asOf, source: "Frankfurter" }
    });
    return { base: from, quote: to, rate, asOf: asOf.toISOString(), source: "Frankfurter" };
  } catch {
    if (cached) {
      return { base: from, quote: to, rate: cached.rate, asOf: cached.asOf.toISOString(), source: `${cached.source} (stale)` };
    }
    throw new Error("Live exchange data is temporarily unavailable. Please try again shortly.");
  }
}

export async function getHistoricalRates(from: string, to: string, days: number): Promise<RatePoint[]> {
  const end = new Date();
  const start = new Date();
  start.setDate(end.getDate() - days);
  const startStr = start.toISOString().split("T")[0];
  const endStr = end.toISOString().split("T")[0];

  const json = await fetchFrankfurter(`${PRIMARY}/${startStr}..${endStr}?base=${from}&symbols=${to}`);
  return Object.entries(json.rates).map(([date, values]) => ({ date, rate: Number((values as Record<string, number>)[to]) }));
}

export function aggregateStats(points: RatePoint[]) {
  if (!points.length) return null;
  const rates = points.map((p) => p.rate);
  const avg = rates.reduce((a, b) => a + b, 0) / rates.length;
  return { high: Math.max(...rates), low: Math.min(...rates), average: avg };
}
