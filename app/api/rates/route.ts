import { NextRequest, NextResponse } from "next/server";
import { getLatestRate } from "@/lib/services/rates";
import { rateQuerySchema } from "@/lib/validators/rates";

export async function GET(req: NextRequest) {
  const parsed = rateQuerySchema.safeParse({
    from: req.nextUrl.searchParams.get("from") || "USD",
    to: req.nextUrl.searchParams.get("to") || "EUR"
  });
  if (!parsed.success) return NextResponse.json({ message: "Invalid currency pair" }, { status: 400 });
  const data = await getLatestRate(parsed.data.from, parsed.data.to);
  return NextResponse.json(data);
}
