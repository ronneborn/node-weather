import Link from "next/link";
import { ConverterCard } from "@/components/converter/converter-card";
import { RateChart } from "@/components/charts/rate-chart";
import { aggregateStats, getHistoricalRates, getLatestRate } from "@/lib/services/rates";

function parsePair(pair: string) {
  const [from, to] = pair.split("-to-");
  return { from: from?.toUpperCase() || "USD", to: to?.toUpperCase() || "EUR" };
}

export default async function PairPage({ params }: { params: { pair: string } }) {
  const { from, to } = parsePair(params.pair);
  const latest = await getLatestRate(from, to);
  const points = await getHistoricalRates(from, to, 30);
  const stats = aggregateStats(points);
  return (
    <div className="space-y-6">
      <h1 className="text-3xl font-bold">{from} to {to} Exchange Rate</h1>
      <ConverterCard initialFrom={from} initialTo={to} initialRate={latest.rate} />
      <p className="text-sm text-slate-500">Latest rate: 1 {from} = {latest.rate} {to}. Updated {new Date(latest.asOf).toLocaleDateString()}.</p>
      <RateChart data={points} />
      {stats && <div className="card text-sm">High: {stats.high.toFixed(4)} · Low: {stats.low.toFixed(4)} · Average: {stats.average.toFixed(4)}</div>}
      <section className="card">
        <h2 className="text-xl font-semibold">FAQ</h2>
        <p className="mt-2 text-sm">Why does the {from}/{to} rate change daily? Rates move with central bank policy, inflation outlook, and market demand.</p>
      </section>
      <section className="card">
        <h2 className="text-xl font-semibold">Related pairs</h2>
        <div className="mt-2 flex gap-3 text-sm"><Link href={`/${to.toLowerCase()}-to-${from.toLowerCase()}`}>{to} to {from}</Link><Link href={`/historical/${from.toLowerCase()}-to-${to.toLowerCase()}`}>Historical chart</Link></div>
      </section>
    </div>
  );
}
