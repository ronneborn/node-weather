import { getLatestRate } from "@/lib/services/rates";

function parseAmountPair(value: string) {
  const parts = value.toLowerCase().split("-");
  const amount = Number(parts[0]);
  const from = parts[1]?.toUpperCase();
  const to = parts[3]?.toUpperCase();
  return { amount: Number.isFinite(amount) ? amount : 1, from: from || "USD", to: to || "EUR" };
}

export default async function AmountPairPage({ params }: { params: { amountPair: string } }) {
  const { amount, from, to } = parseAmountPair(params.amountPair);
  const latest = await getLatestRate(from, to);
  const total = amount * latest.rate;
  return (
    <div className="space-y-4">
      <h1 className="text-3xl font-bold">{amount} {from} to {to}</h1>
      <div className="card"><p className="text-2xl font-semibold">{total.toLocaleString(undefined, { maximumFractionDigits: 4 })} {to}</p><p className="text-sm text-slate-500">Based on the latest reference exchange rate.</p></div>
    </div>
  );
}
