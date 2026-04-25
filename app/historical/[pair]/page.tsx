import { RateChart } from "@/components/charts/rate-chart";
import { aggregateStats, getHistoricalRates } from "@/lib/services/rates";

export default async function HistoricalPage({ params }: { params: { pair: string } }) {
  const [from, to] = params.pair.split("-to-").map((v) => v.toUpperCase());
  const points = await getHistoricalRates(from, to, 365);
  const stats = aggregateStats(points);
  return (
    <div className="space-y-4">
      <h1 className="text-3xl font-bold">Historical {from}/{to} exchange rates</h1>
      <RateChart data={points} />
      {stats && <div className="card">High {stats.high.toFixed(4)} · Low {stats.low.toFixed(4)} · Average {stats.average.toFixed(4)}</div>}
    </div>
  );
}
