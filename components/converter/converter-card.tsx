"use client";

import { useEffect, useMemo, useState } from "react";
import { currencies } from "@/lib/data/currencies";

const quickAmounts = [1, 5, 10, 20, 50, 100, 500, 1000];

export function ConverterCard({ initialFrom = "USD", initialTo = "EUR", initialRate = 0 }: { initialFrom?: string; initialTo?: string; initialRate?: number }) {
  const [amount, setAmount] = useState("1");
  const [from, setFrom] = useState(initialFrom);
  const [to, setTo] = useState(initialTo);
  const [rate, setRate] = useState(initialRate);
  const [updatedAt, setUpdatedAt] = useState("");
  const [source, setSource] = useState("Frankfurter");

  const converted = useMemo(() => Number(amount || 0) * rate, [amount, rate]);

  useEffect(() => {
    localStorage.setItem("last_pair", JSON.stringify({ from, to }));
  }, [from, to]);

  useEffect(() => {
    const run = async () => {
      const res = await fetch(`/api/rates?from=${from}&to=${to}`);
      const data = await res.json();
      setRate(data.rate);
      setUpdatedAt(data.asOf);
      setSource(data.source);
    };
    run();
  }, [from, to]);

  const swap = () => {
    setFrom(to);
    setTo(from);
  };

  return (
    <div className="card space-y-4">
      <div className="grid gap-3 md:grid-cols-4">
        <input className="rounded-xl border px-3 py-2" inputMode="decimal" value={amount} onChange={(e) => setAmount(e.target.value)} />
        <select className="rounded-xl border px-3 py-2" value={from} onChange={(e) => setFrom(e.target.value)}>{currencies.map((c) => <option key={c}>{c}</option>)}</select>
        <button className="rounded-xl border px-3 py-2" onClick={swap}>Swap</button>
        <select className="rounded-xl border px-3 py-2" value={to} onChange={(e) => setTo(e.target.value)}>{currencies.map((c) => <option key={c}>{c}</option>)}</select>
      </div>
      <div>
        <p className="text-sm text-slate-500">Converted amount</p>
        <p className="text-3xl font-bold">{converted.toLocaleString(undefined, { maximumFractionDigits: 6 })} {to}</p>
        <p className="text-xs text-slate-500">Last updated: {updatedAt ? new Date(updatedAt).toLocaleString() : "-"} · Source: {source}</p>
      </div>
      <div className="flex flex-wrap gap-2">
        {quickAmounts.map((qa) => (
          <button key={qa} className="rounded-full border px-3 py-1 text-sm" onClick={() => setAmount(String(qa))}>{qa}</button>
        ))}
        <button className="rounded-full border px-3 py-1 text-sm" onClick={() => navigator.clipboard.writeText(String(converted))}>Copy result</button>
      </div>
    </div>
  );
}
